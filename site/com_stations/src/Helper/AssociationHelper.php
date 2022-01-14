<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 */

namespace Joomla\Component\Stations\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\Component\Categories\Administrator\Helper\CategoryAssociationHelper;
use Joomla\Component\Stations\Site\Helper\RouteHelper;

/**
 * Stations Component Association Helper
 *
 * @since  __BUMP_VERSION__
 */
abstract class AssociationHelper extends CategoryAssociationHelper
{
    /**
     * Method to get the associations for a given item
     *
     * @param   integer  $id    Id of the item
     * @param   string   $view  Name of the view
     *
     * @return  array   Array of associations for the item
     *
     * @since  __BUMP_VERSION__
     */
    public static function getAssociations($id = 0, $view = null)
    {
        $jinput = Factory::getApplication()->input;
        $view = $view ?? $jinput->get('view');
        $id = empty($id) ? $jinput->getInt('id') : $id;

        if ($view === 'destinations') {
            if ($id) {
                $associations = Associations::getAssociations('com_stations', '#__stations_destinations', 'com_stations.item', $id);

                $return = [];

                foreach ($associations as $tag => $item) {
                    $return[$tag] = RouteHelper::getDestinationsRoute($item->id, (int) $item->catid, $item->language);
                }

                return $return;
            }
        }

        if ($view === 'category' || $view === 'categories') {
            return self::getCategoryAssociations($id, 'com_stations');
        }

        return [];
    }
}
