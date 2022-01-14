<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Stations\Site\Dispatcher;

\defined('_JEXEC') or die('Restricted Direct Access!');

use Joomla\CMS\Dispatcher\ComponentDispatcher;
use Joomla\CMS\MVC\Controller\BaseController;

/**
 * ComponentDispatcher class for com_stations
 *
 * @since  3.0
 */
class Dispatcher extends ComponentDispatcher
{
	/**
	 * Dispatch a controller task. Redirecting the user if appropriate.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function dispatch()
	{
		/**
		 * If you want to logically restrict the component to perform any controller task
		 * then write down your logics here.
		 *
		 * @see	con_content as reference.
		 */
		parent::dispatch();
	}
	/**
	 * Load the language from the admin language
	 *
	 * @since   3.0
	 *
	 * @return  void
	 */
	protected function loadLanguage()
	{
		parent::loadLanguage();

		/**
		 * If you want to load language strings from admin,
		 * rather than site language then uncomment the line below.
		*/

		// $this->app->getLanguage()->load('com_stations', JPATH_ADMINISTRATOR);
	}

	/**
	 * Dispatch a controller task. Redirecting the user if appropriate.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function checkAccess()
	{
		parent::checkAccess();

		/**
		 * Write down your own business logic for checking access.
		 * In the case of access denial throw NotAllowed|Exception.
		 *
		 * @see	com_config as reference.
		 */
	}

	/**
	 * Get a controller from the component
	 *
	 * @param   string  $name    Controller name
	 * @param   string  $client  Optional client (like Administrator, Site etc.)
	 * @param   array   $config  Optional controller config
	 *
	 * @return  \Joomla\CMS\MVC\Controller\BaseController
	 *
	 * @since   1.0.0
	 */
	public function getController(string $name, string $client = '', array $config = array()): BaseController
	{
		/**
		 * Write down your logic here if your want to change the location of your controllers
		 * to the Administrator component.
		 *
		 * @see	com_menus as reference.
		 */

		return parent::getController($name, $client, $config);
	}
}
