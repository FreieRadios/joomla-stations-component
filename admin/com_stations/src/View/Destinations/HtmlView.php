<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Stations\Administrator\View\Destinations;

\defined('_JEXEC') or die('Restricted Direct Access!');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarFactoryInterface;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Stations\Administrator\Helper\StationsHelper;


class HtmlView extends BaseHtmlView
{
	/**
	 * An array of items
	 *
	 * @var  	array
	 *
	 * @since	3.0
	 */
	protected $items;

	/**
	 * The pagination object
	 *
	 * @var  	\JPagination
	 *
	 * @since	3.0
	 */
	protected $pagination;

	/**
	 * The model state
	 *
	 * @var  	\JObject
	 *
	 * @since	3.0
	 */
	protected $state;

	/**
	 * Form object for search filters
	 *
	 * @var  	\JForm
	 *
	 * @since	3.0
	 */
	public $filterForm;

	/**
	 * The active search filters
	 *
	 * @var  	array
	 *
	 * @since	3.0
	 */
	public $activeFilters;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since	3.0
	 */
	public function display($tpl = null)
	{
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state         = $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		$errors = $this->get('Errors');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}
        // If we are forcing a language in modal (used for associations).
        if ($this->getLayout() === 'modal' && $forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'cmd')) {
            // Set the language field to the forcedLanguage and disable changing it.
            $this->form->setValue('language', null, $forcedLanguage);
            $this->form->setFieldAttribute('language', 'readonly', 'true');

            // Only allow to select categories with All language or with the forced language.
            $this->form->setFieldAttribute('catid', 'language', '*,' . $forcedLanguage);

            // Only allow to select tags with All language or with the forced language.
            $this->form->setFieldAttribute('tags', 'language', '*,' . $forcedLanguage);
        }
		$this->addToolbar();

		return parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	protected function addToolbar()
	{
		$canDo = StationsHelper::getActions('com_stations');
		$user  = Factory::getApplication()->getIdentity();

		// Get the toolbar object instance
		$toolbar = Toolbar::getInstance('toolbar');

		ToolbarHelper::title(Text::_('COM_STATIONS_DESTINATION_TOOLBAR_LABEL'), 'book');
		if ($canDo->get('core.create'))
		{
			$toolbar->addNew('destination.add');
		}

		if ($canDo->get('core.edit.state'))
		{
			$dropdown = $toolbar->dropdownButton('status-group')
				->text('JTOOLBAR_CHANGE_STATUS')
				->toggleSplit(false)
				->icon('icon-ellipsis-h')
				->buttonClass('btn btn-action')
				->listCheck(true);

			$childBar = $dropdown->getChildToolbar();

			$childBar->publish('destinations.publish')->listCheck(true);

			$childBar->unpublish('destinations.unpublish')->listCheck(true);

			$childBar->archive('destinations.archive')->listCheck(true);

			if ($user->authorise('core.admin'))
			{
				$childBar->checkin('destinations.checkin')->listCheck(true);
			}

			if ((int) $this->state->get('filter.published') !== -2)
			{
				$childBar->trash('destinations.trash')->listCheck(true);
			}
		}

		if ((int) $this->state->get('filter.published') === -2 && $canDo->get('core.delete'))
		{
			$toolbar->delete('destinations.delete')
				->text('JTOOLBAR_EMPTY_TRASH')
				->message('JGLOBAL_CONFIRM_DELETE')
				->listCheck(true);
		}

		if ($user->authorise('core.admin', 'com_stations') || $user->authorise('core.options', 'com_stations'))
		{
			$toolbar->preferences('com_stations');
		}
	}
}