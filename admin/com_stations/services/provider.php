<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted direct access!');

use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Component\Stations\Administrator\Extension\StationsComponent;
use Joomla\Component\Stations\Administrator\Helper\AssociationsHelper;
use Joomla\CMS\Association\AssociationExtensionInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The component service provider.
 *
 * @since  3.0
 */
return new class implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function register(Container $container)
	{

        $container->set(AssociationExtensionInterface::class, new AssociationsHelper);
        $container->registerServiceProvider(new CategoryFactory('\Joomla\Component\Stations'));
		$container->registerServiceProvider(new MVCFactory('Joomla\Component\Stations'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('Joomla\Component\Stations'));
		$container->registerServiceProvider(new RouterFactory('Joomla\Component\Stations'));

		$container->set(
			ComponentInterface::class,
			function (Container $container)
			{
				$component = new StationsComponent($container->get(ComponentDispatcherFactoryInterface::class));

				$component->setRegistry($container->get(Registry::class));
				$component->setMVCFactory($container->get(MVCFactoryInterface::class));
                $component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
                $component->setAssociationExtension($container->get(AssociationExtensionInterface::class));
				$component->setRouterFactory($container->get(RouterFactoryInterface::class));

				return $component;
			}
		);
	}
};
