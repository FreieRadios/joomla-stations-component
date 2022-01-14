<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 */

namespace Joomla\Component\Stations\Site\Helper;

\defined('_JEXEC') or die('Restricted Direct Access!');

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\RouteHelper as CMSRouteHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Categories\CategoryNode;


/**
 * Tags Component Route Helper.
 *
 * @since  3.0
 */
class RouteHelper extends CMSRouteHelper
{
	/**
	 * Get destination route.
	 *
	 * @param	string	$view		The singular view name.
	 * @param	int		$id			The destination id.
	 * @param	string	$alias		The destination alias.
	 * @param	string	$language	The language string.
	 *
	 * @return	string	The router link.
	 *
	 * @since	3.0
	 */
	public static function generateUrl(string $view, int $id, string $alias, string $language = '*') : string
	{
		$link = '';

		if ($id < 1)
		{
			return $link;
		}

		// Create the link
		$link = 'index.php?option=com_stations&view=' . $view . '&id=' . $id . ':' . $alias;

		if ($language !== '*' && Multilanguage::isEnabled())
		{
			$link .= '&lang=' . $language;
		}

		return $link;
	}

    /**
     * Get the URL route for a station from a station ID, stations category ID and language
     *
     * @param   integer  $id        The id of the stations
     * @param   integer  $catid     The id of the stations's category
     * @param   mixed    $language  The id of the language being used.
     *
     * @return  string  The link to the stations
     *
     * @since   __DEPLOY_VERSION__
     */
    public static function getDestinationRoute($id, $catid, $language = 0)
    {
        // Create the link
        $link = 'index.php?option=com_stations&view=destination&id=' . $id;

        if ($catid > 1) {
            $link .= '&catid=' . $catid;
        }

        if ($language && $language !== '*' && Multilanguage::isEnabled()) {
            $link .= '&lang=' . $language;
        }

        return $link;
    }
    public static function getDestinationsRoute($id, $catid, $language = 0)
    {
        // Create the link
        $link = 'index.php?option=com_stations&view=destinations&id=' . $id;

        if ($catid > 1) {
            $link .= '&catid=' . $catid;
        }

        if ($language && $language !== '*' && Multilanguage::isEnabled()) {
            $link .= '&lang=' . $language;
        }

        return $link;
    }

    /**
     * Get the URL route for a stations category from a stations category ID and language
     *
     * @param   mixed  $catid     The id of the stations's category either an integer id or an instance of CategoryNode
     * @param   mixed  $language  The id of the language being used.
     *
     * @return  string  The link to the stations
     *
     * @since   __DEPLOY_VERSION__
     */
    public static function getCategoryRoute($catid, $language = 0)
    {
        if ($catid instanceof CategoryNode) {
            $id = $catid->id;
        } else {
            $id = (int) $catid;
        }

        if ($id < 1) {
            $link = '';
        } else {
            // Create the link
            $link = 'index.php?option=com_destinations&view=category&id=' . $id;

            if ($language && $language !== '*' && Multilanguage::isEnabled()) {
                $link .= '&lang=' . $language;
            }
        }

        return $link;
    }
}
