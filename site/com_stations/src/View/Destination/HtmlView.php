<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Stations\Site\View\Destination;

\defined('_JEXEC') or die('Restricted Direct Access!');

use Joomla\CMS\Categories\Categories;
use Joomla\CMS\Factory;
use Joomla\CMS\Feed\FeedFactory;
use Joomla\CMS\Helper\TagsHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * HTML View class for the Stations component
 *
 * @since  3.0
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * The model state
	 *
	 * @var     object
	 * @since   3.0
	 */
	protected $state;

	/**
	 * The destination item
	 *
	 * @var     object
	 * @since   3.0
	 */
	protected $item;

	/**
	 * The current user instance
	 *
	 * @var    \JUser|null
	 * @since  3.0
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
	protected $params;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since   3.0
	 */
	public function display($tpl = null)
	{
		$app  = Factory::getApplication();
		$user = $app->getIdentity();

		$state = $this->get('State');
		$item  = $this->get('Item');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}
		$params = $state->get('params');

		// Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->params = $params;
		$this->state  = $state;
		$this->item   = $item;
		$this->user   = $user;

		return parent::display($tpl);
	}
}
