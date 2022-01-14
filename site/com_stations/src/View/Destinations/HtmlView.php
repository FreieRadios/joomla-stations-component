<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Stations\Site\View\Destinations;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Stations\Site\Helper\RouteHelper;

/**
 * Frontpage View class
 *
 * @since  3.0
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * The model state
	 *
	 * @var  \JObject
	 */
	protected $state = null;

	/**
	 * The featured destinations array
	 *
	 * @var  \stdClass[]
	 */
	protected $items = null;

	/**
	 * The pagination object.
	 *
	 * @var  \JPagination
	 */
	protected $pagination = null;

	/**
	 * The user object
	 *
	 * @var  \JUser|null
	 */
	protected $user = null;

	/**
	 * The page class suffix
	 *
	 * @var    string
	 * @since  3.0
	 */
	protected $pageclass_sfx = '';

	/**
	 * The page parameters
	 *
	 * @var    \Joomla\Registry\Registry|null
	 * @since  3.0
	 */
	protected $params = null;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
	{
		$user = Factory::getApplication()->getIdentity();

		$state      = $this->get('State');
		$items      = $this->get('Items');
		$pagination = $this->get('Pagination');

		// Flag indicates to not add limitstart=0 to URL
		$pagination->hideEmptyLimitstart = true;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}

		/** @var \Joomla\Registry\Registry $params */
		$params = &$state->params;

		foreach ($items as &$item)
		{
			$item->url = RouteHelper::generateUrl('destination', $item->id, $item->alias, $item->language);
		}

		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->params     = $params;
		$this->items      = $items;
		$this->pagination = $pagination;
		$this->user       = $user;

		parent::display($tpl);
	}

}
