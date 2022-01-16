<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 *
 * @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Stations\Site\Model;

\defined('_JEXEC') or die('Restricted Direct Access!');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\Database\ParameterType;

/**
 * Model class for Destination view.
 *
 * @since  3.0
 */
class DestinationModel extends ItemModel
{
	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	protected $_context = 'com_stations.destination';

	/**
	 * Method to auto-populate the model state.
	 *
	 * Destination. Calling getState in this method will result in recursion.
	 *
	 * @since   3.0
	 *
	 * @return void
	 */
	protected function populateState()
	{
		$app = Factory::getApplication();

		// Load state from the request.
		$pk = $app->input->getInt('id');
		$this->setState('destination.id', $pk);

		$offset = $app->input->getUInt('limitstart');
		$this->setState('list.offset', $offset);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);

		$this->setState('filter.language', Multilanguage::isEnabled());
	}

	/**
	 * Method to get destination data.
	 *
	 * @param   integer  $pk  The id of the destination.
	 *
	 * @return  object|boolean  Menu item data object on success, boolean false
	 */
	public function getItem($pk = null)
	{
		$user = Factory::getApplication()->getIdentity();

		$pk = (int) ($pk ?: $this->getState('destination.id'));

		if ($this->_item === null)
		{
			$this->_item = array();
		}

		if (!isset($this->_item[$pk]))
		{
			try
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
								'a.id, a.name, a.address, a.zipcode, a.town, a.www, a.livestream, a.mhz'
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
				
				$query->where($db->quoteName('a.id') . ' = :pk')
					->bind(':pk', $pk, ParameterType::INTEGER);

				// Filter by access level.
				if ($access = $this->getState('filter.access'))
				{
					$query->where($db->quoteName('a.access') . ' = :access');
					$query->bind(':access', $access, ParameterType::INTEGER);
				}

				$query->select($db->quoteName('ua.name', 'author_name'))
				->join(
					'LEFT',
					$db->quoteName('#__users', 'ua') . ' ON ' . $db->quoteName('ua.id') . ' = ' . $db->quoteName('a.created_by')
				);

				// Filter by published state
				$published = (string) $this->getState('filter.published');

				if (is_numeric($published))
				{$categoryId = (int) $categoryId;
				$levels     = (int) $this->getState('filter.max_category_levels', 1);

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
					'(' . $db->quoteName('a.catid') . $type . ':categoryId OR ' . $db->quoteName('a.catid') . ' IN (' . (string) $subQuery . '))'
				);
				$query->bind(':categoryId', $categoryId, ParameterType::INTEGER);
					$query->where($db->quoteName('a.published') . ' = :published');
					$query->bind(':published', $published, ParameterType::INTEGER);
				}
				elseif ($published === '')
				{
					$query->where('(' . $db->quoteName('a.published') . ' = 0 OR ' . $db->quoteName('a.published') . ' = 1)');
				}

				// Filter on the language.
				if ($language = $this->getState('filter.language') && Multilanguage::isEnabled())
				{
					$query->where($db->quoteName('a.language') . ' = :language');
					$query->bind(':language', $language);
				}

				$db->setQuery($query);
				$data = $db->loadObject();

				if (empty($data))
				{
					throw new \Exception('');
				}

				$this->_item[$pk] = $data;
			}
			catch (\Exception $e)
			{
				if ($e->getCode() == 404)
				{
					// Need to go through the error handler to allow Redirect to work.
					throw $e;
				}
				else
				{
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
	}
}
