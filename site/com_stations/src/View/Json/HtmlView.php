<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 */

namespace Joomla\Component\Stations\Site\View\Json;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\CategoryView;
use Joomla\Component\Stations\Site\Helper\RouteHelper;
use Joomla\Component\Stations\Site\Model\DestinationsModel;

/**
 * HTML View class for the Stations component
 *
 * @since  __BUMP_VERSION__
 */
class HtmlView extends CategoryView
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

        foreach ($this->items as $item) {
            $item->slug = $item->id;
            $temp = $item->params;
            $item->params = clone $this->params;
            $item->params->merge($temp);
            $item->url = (!preg_match("~^(?:f|ht)tps?://~i", $item->www)) ?  'https://' . $item->www : $item->www;
            $item->www =   $link = str_replace(array('http://', 'https://'), '', $item->www);
        }

        return parent::display($tpl);
    }

    /**
     * Prepares the document
     *
     * @return  void
     */
    protected function prepareDocument()
    {
        parent::prepareDocument();

        $menu = $this->menu;
        $id = (int) @$menu->query['id'];

        if ($menu && (!isset($menu->query['option']) || $menu->query['option'] != $this->extension || $menu->query['view'] == $this->viewName
                || $id != $this->category->id)) {
            $path = [['title' => $this->category->title, 'link' => '']];
            $category = $this->category->getParent();

            while ((!isset($menu->query['option']) || $menu->query['option'] !== 'com_stations' || $menu->query['view'] === 'destination'
                    || $id != $category->id) && $category->id > 1) {
                $path[] = ['title' => $category->title, 'link' => RouteHelper::getCategoryRoute($category->id, $category->language)];
                $category = $category->getParent();
            }

            $path = array_reverse($path);

            foreach ($path as $item) {
                $this->pathway->addItem($item['title'], $item['link']);
            }
        }

        parent::addFeed();
    }
    private function getDestinations() {
        $model = new DestinationsModel();
    }
}
