<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Stations\Site\Model;

\defined('_JEXEC') or die('Restricted Direct Access!');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;

/**
 * This models supports retrieving lists of destinations.
 *
 * @since  3.0
 */
class DestinationsModel extends ListModel
{
	/**
	 * Constructor method.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     \JController
	 *
	 * @since   3.0
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
                'a.address','address',
                'a.zipcode','zipcode',
                'a.logo','logo',
                'a.town','town',
                'a.www','www',
                'a.livestream','livestream',
                'a.reception','reception',
                'catid', 'a.catid', 'category_id', 'category_title',
				'alias', 'a.alias',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'published', 'a.published',
				'access', 'a.access', 'access_level',
				'created', 'a.created',
				'created_by', 'a.created_by',
				'ordering', 'a.ordering',
				'language', 'a.language',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
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
	protected function populateState($ordering = 'ordering', $direction = 'ASC')
	{
		$app = Factory::getApplication();

		// List state information
		$value = $app->input->get('limit', $app->get('list_limit', 0), 'uint');
		$this->setState('list.limit', $value);

		$offset = $app->input->get('limitstart', 0, 'uint');
		$this->setState('list.start', $offset);

		$params = $app->getParams();
		$this->setState('params', $params);

		$this->setState('filter.published', 1);
		$this->setState('filter.access', true);

		$orderCol = $app->input->get('filter_order', 'a.ordering');

		if (!in_array($orderCol, $this->filter_fields))
		{
			$orderCol = 'a.ordering';
		}

		$this->setState('list.ordering', $orderCol);

		$listOrder = $app->input->get('filter_order_Dir', 'ASC');

		if (!in_array(strtoupper($listOrder), array('ASC', 'DESC', '')))
		{
			$listOrder = 'ASC';
		}

		$this->setState('list.direction', $listOrder);

		$this->setState('filter.language', Multilanguage::isEnabled());
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
		$id .= ':' . $this->getState('filter.level');

		return parent::getStoreId($id);
	}

	/**
	 * Get the master query for retrieving a list of destinations.
	 *
	 * @return  \JDatabaseQuery
	 *
	 * @since   3.0
	 */
	protected function getListQuery()
	{
        $categoryId = $this->getState('filter.category_id');
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
						'a.id, a.name, a.alias, a.txt, a.address, a.zipcode, a.logo, a.town, a.www, a.livestream, a.reception, a.long, a.lat'
					)
				)
			)
		);

		$query->from($db->quoteName('#__stations_destinations', 'a'));
        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );
		$query->select($db->quoteName('l.title', 'language_title'))
			->select($db->quoteName('l.image', 'language_image'))
			->join(
				'LEFT',
				$db->quoteName('#__languages', 'l') . ' ON ' . $db->quoteName('l.lang_code') . ' = ' . $db->quoteName('a.language')
			);

		// Join over the users for the checked out user.
		$query->select($db->quoteName('uc.name', 'editor'))
			->join(
				'LEFT',
				$db->quoteName('#__users', 'uc') . ' ON ' . $db->quoteName('uc.id') . ' = ' . $db->quoteName('a.checked_out')
			);

		// Join over the asset groups.
		$query->select($db->quoteName('ag.title', 'access_level'))
			->join(
				'LEFT',
				$db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
			);



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
        if($categoryId) {
            $categoryId = (int) $categoryId;
            $levels     = (int) $this->getState('filter.max_category_levels', 10);

            // Create a subquery for the subcategory list
            $subQuery = $db->getQuery(true)
                ->select($db->quoteName('sub.id'))
                ->from($db->quoteName('#__categories', 'sub'))
                ->join(
                    'INNER',
                    $db->quoteName('#__categories', 'this'),
                    $db->quoteName('sub.lft') . ' > ' . $db->quoteName('this.lft')
                    . ' AND ' . $db->quoteName('sub.rgt') . ' < ' . $db->quoteName('this.rgt')
                )
                ->where($db->quoteName('this.id') . ' = :subCategoryId');

            $query->bind(':subCategoryId', $categoryId, ParameterType::INTEGER);

            if ($levels >= 0)
            {
                $subQuery->where($db->quoteName('sub.level') . ' <= ' . $db->quoteName('this.level') . ' + :levels');
                $query->bind(':levels', $levels, ParameterType::INTEGER);
            }

            // Add the subquery to the main query
            $query->where(
                '(' . $db->quoteName('a.catid') . '=' . ':categoryId OR ' . $db->quoteName('a.catid') . ' IN (' . (string) $subQuery . '))'
            );
            $query->bind(':categoryId', $categoryId, ParameterType::INTEGER);
        }
		// Filter on the language.
		if ($language = $this->getState('filter.language'))
		{
			$query->where($db->quoteName('a.language') . ' = :language');
			$query->bind(':language', $language);
		}

		// Add the list ordering clause.
		$orderCol = $db->quoteName('category_title'). ', '.$this->state->get('list.ordering', 'a.name');
		$orderDirn = $this->state->get('list.direction', 'asc');

		if ($orderCol === 'a.ordering' || $orderCol == 'category_title')
		{
			$orderCol = $db->quoteName('category_title') .','. $db->quoteName('a.ordering');
		}

		$query->order($db->escape($orderCol . ' ' . $orderDirn));
		return $query;
	}

	/**
	 * Method to get a list of destinations.
	 *
	 * Overridden to inject convert the attribs field into a Registry object.
	 *
	 * @return  mixed  An array of objects on success, false on failure.
	 *
	 * @since   3.0
	 */
	public function getItems()
	{

		return parent::getItems();
	}
}
