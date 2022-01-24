<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 */

namespace Joomla\Component\Stations\Site\View\Category;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\CategoryView;
use \Joomla\CMS\Response\JsonResponse;

/**
 * HTML View class for the Stations component
 *
 * @since  __BUMP_VERSION__
 */
class JsonView extends CategoryView
{
    /**
     * @var    string  The name of the extension for the category
     * @since  __BUMP_VERSION__
     */
    protected $extension = 'com_stations';

    /**
     * @var    string  Default title to use for page title
     * @since  __BUMP_VERSION__
     */
    protected $defaultPageTitle = 'COM_STATIONS_DEFAULT_PAGE_TITLE';

    /**
     * @var    string  The name of the view to link individual items to
     * @since  __BUMP_VERSION__
     */
    protected $viewName = 'destination';

    /**
     * Run the standard Joomla plugins
     *
     * @var    boolean
     * @since  __BUMP_VERSION__
     */
    protected $runPlugins = true;

    /**
     * Execute and display a template script.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        parent::commonCategoryDisplay();

        $this->pagination->hideEmptyLimitstart = true;
        $items = [];
        foreach ($this->items as $item) {
            $item->www = (!preg_match("~^(?:f|ht)tps?://~i", $item->www)) ?  'https://' . $item->www : $item->www;
            $feature = array(
                'id' => $item->id,
                'type' => 'Feature',
                # Pass other attribute columns here
                'properties' => array(
                    'name' => $item->name,
                    'PLZ_Ort' => $item->zipcode . " " .$item->town,
                    'Adresse'  => $item->address,
                    'Web' => $item->www,
                    'UKW' => $item->mhz . " MHz",
                    'url'  => $item->logo,
                    'livestream'  => $item->livestream,
                ),
                'geometry' => array(
                    'type' => 'Point',
                    # Pass Longitude and Latitude Columns here
                    'coordinates' => [$item->long, $item->lat]
                ),

            );


            $items[] = $feature;

        }
        $data = (object) ['type' => 'FeatureCollection', 'feature' => $items];
        header('Content-Type: application/json');
        echo  json_encode($data, JSON_NUMERIC_CHECK);
        exit;


    }

}
