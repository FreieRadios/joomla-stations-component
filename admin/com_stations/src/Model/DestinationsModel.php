<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_stations
 *
* @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Stations\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Table\Table;
\defined('_JEXEC') or die('Restricted Direct Access!');

/**
 * Category listing model.
 *
 * @since	3.0
 */
class DestinationsModel extends ListModel
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     \JControllerLegacy
	 *
	 * @since   3.0
	 */
	public function __construct($config = [])
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
                'zipcode', 'a.zipcode',
                'town', 'a.town',
				'alias', 'a.alias',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'published', 'a.published',
				'access', 'a.access', 'access_level',
				'created', 'a.created',
				'created_by', 'a.created_by',
				'ordering', 'a.ordering',
				'language', 'a.language', 'language_title',
                'catid', 'a.catid', 'category_title',
                'category_id',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Destination. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	protected function populateState($ordering = 'a.name', $direction = 'asc')
	{
		$app = Factory::getApplication();

		$forcedLanguage = $app->getInput()->get('forcedLanguage', '', 'cmd');

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout'))
		{
			$this->context .= '.' . $layout;
		}

		// Adjust the context to support forced languages.
		if ($forcedLanguage)
		{
			$this->context .= '.' . $forcedLanguage;
		}

		// List state information.
		parent::populateState($ordering, $direction);

		// Force a language.
		if (!empty($forcedLanguage))
		{
			$this->setState('filter.language', $forcedLanguage);
		}
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   3.0
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.published');
		$id .= ':' . $this->getState('filter.access');
		$id .= ':' . $this->getState('filter.language');
        $id .= ':' . $this->getState('filter.category_id');
		$id .= ':' . serialize($this->getState('filter.tag'));
		$id .= ':' . $this->getState('filter.level');

		return parent::getStoreId($id);
	}

/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  \JDatabaseQuery
	 *
	 * @since   3.0
	 */
	protected function getListQuery()
	{
		$container = Factory::getContainer();
		$app = Factory::getApplication();
		$db = $container->get('DatabaseDriver');
		$query = $db->getQuery(true);
		$user = $app->getIdentity();

		$query->select(
			$db->quoteName(
				explode(
					', ',
					$this->getState(
						'list.select',
						'a.id, a.name, a.zipcode, town, a.alias, a.published, a.access, a.created, a.created_by, a.ordering, a.language, a.catid, ' .
						'a.checked_out, a.checked_out_time'
					)
				)
			)
		);

		$query->from($db->quoteName('#__stations_destinations', 'a'));

		$query->select($db->quoteName('l.title', 'language_title'))
			->select($db->quoteName('l.image', 'language_image'))
			->join(
				'LEFT',
				$db->quoteName('#__languages', 'l') . ' ON ' . $db->quoteName('l.lang_code') . ' = ' . $db->quoteName('a.language')
			);

        $query->join('LEFT', $db->quoteName('#__categories', 'c'), $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid'))
            ->join('LEFT', $db->quoteName('#__categories', 'parent'), $db->quoteName('parent.id') . ' = ' . $db->quoteName('c.parent_id'));

		// Join over the users for the checked out user.
		$query->select($db->quoteName('uc.name', 'editor'))
			->join(
				'LEFT',
				$db->quoteName('#__users', 'uc') . ' ON ' . $db->quoteName('uc.id') . ' = ' . $db->quoteName('a.checked_out')
			);

		$query->select($db->quoteName('ua.name', 'author_name'))
		->join(
			'LEFT',
			$db->quoteName('#__users', 'ua') . ' ON ' . $db->quoteName('ua.id') . ' = ' . $db->quoteName('a.created_by')
		);

		// Join over the asset groups.
		$query->select($db->quoteName('ag.title', 'access_level'))
			->join(
				'LEFT',
				$db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
			);

		// Filter by access level.
		if ($access = $this->getState('filter.access'))
		{
			$query->where($db->quoteName('a.access') . ' = :access');
			$query->bind(':access', $access, ParameterType::INTEGER);
		}

		// Implement View Level Access
		if (!$user->authorise('core.admin'))
		{
			$query->whereIn($db->quoteName('a.access'), $user->getAuthorisedViewLevels());
		}

		// Filter by published state
		$published = (string) $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where($db->quoteName('a.published') . ' = :published');
			$query->bind(':published', $published, ParameterType::INTEGER);
		}
		elseif ($published === '')
		{
			$query->where('(' . $db->quoteName('a.published') . ' = 0 OR ' . $db->quoteName('a.published') . ' = 1)');
		}

		// Filter by search in name.
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$search = substr($search, 3);
				$query->where($db->quoteName('a.id') . ' = :id');
				$query->bind(':id', $search, ParameterType::INTEGER);
			}
			else
			{
				$search = '%' . trim($search) . '%';
				$query->where(
					'(' . $db->quoteName('a.name') . ' LIKE :name OR ' . $db->quoteName('a.alias') . ' LIKE :alias)'
				);
				$query->bind(':name', $search);
				$query->bind(':alias', $search);
			}
		}

		// Filter on the language.
		if ($language = $this->getState('filter.language'))
		{
			$query->where($db->quoteName('a.language') . ' = :language');
			$query->bind(':language', $language);
		}

        $categoryId = $this->getState('filter.category_id', array());
        if (!is_array($categoryId))
        {
            $categoryId = $categoryId ? array($categoryId) : array();
        }
        // Case: Using both categories filter and by level filter
        if (count($categoryId))
        {
            $categoryId = ArrayHelper::toInteger($categoryId);
            $categoryTable = Table::getInstance('Category', 'JTable');
            $subCatItemsWhere = array();

            foreach ($categoryId as $key => $filter_catid)
            {
                $categoryTable->load($filter_catid);

                // Because values to $query->bind() are passed by reference, using $query->bindArray() here instead to prevent overwriting.
                $valuesToBind = [$categoryTable->lft, $categoryTable->rgt];

                // Bind values and get parameter names.
                $bounded = $query->bindArray($valuesToBind);

                $categoryWhere = $db->quoteName('c.lft') . ' >= ' . $bounded[0] . ' AND ' . $db->quoteName('c.rgt') . ' <= ' . $bounded[1];


                $subCatItemsWhere[] = '(' . $categoryWhere . ')';
            }

            $query->where('(' . implode(' OR ', $subCatItemsWhere) . ')');
        }


        // Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'a.name');
		$orderDirn = $this->state->get('list.direction', 'asc');

		if ($orderCol === 'a.ordering')
		{
			$orderCol = $db->quoteName('a.ordering');
		}

		$query->order($db->escape($orderCol . ' ' . $orderDirn));
		return $query;
	}
}
