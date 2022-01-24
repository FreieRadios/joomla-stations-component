<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');

$app = Factory::getApplication();
$input = $app->getInput();


$assoc = Associations::isEnabled();

$this->ignore_fieldsets = ['item_associations'];
$this->useCoreUI = true;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');
// In case of modal
$isModal = $input->get('layout') === 'modal';
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_stations&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="destination-form" aria-label="<?php echo Text::_('COM_STATIONS_DESTINATION_' . ( (int) $this->item->id === 0 ? 'NEW' : 'EDIT'), true); ?>" class="form-validate">

	<?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

	<div>
		<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('COM_STATIONS_GLOBAL_TAB_BASIC')); ?>
		<div class="row">
			<div class="col-lg-9">
				<div class="card">
					<div class="card-body">
						<?php echo $this->form->renderField('name'); ?>
                        <?php echo $this->form->renderField('catid'); ?>

                        <?php echo $this->form->renderField('address'); ?>

                        <?php echo $this->form->renderField('zipcode'); ?>

                        <?php echo $this->form->renderField('town'); ?>

                        <?php echo $this->form->renderField('www'); ?>

                        <?php echo $this->form->renderField('livestream'); ?>

                        <?php echo $this->form->renderField('frn_id'); ?>

                        <?php echo $this->form->renderField('mhz'); ?>

                        <?php echo $this->form->renderField('logo'); ?>

                        <?php echo $this->form->renderField('lat'); ?>

                        <?php echo $this->form->renderField('long'); ?>

                        <?php echo $this->form->renderField('txt'); ?>


                    </div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="card">
					<div class="card-body">
						<?php $this->set('fields',
								array(
									'published',
									'created_by',
									'created',
									'access',
									'language'
								)
						); ?>
						<?php echo LayoutHelper::render('joomla.edit.global', $this); ?>

					</div>
				</div>
			</div>
		</div>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>
        <?php if ($assoc) : ?>
            <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'associations', Text::_('JGLOBAL_FIELDSET_ASSOCIATIONS')); ?>
            <?php echo $this->loadTemplate('associations'); ?>
            <?php echo HTMLHelper::_('uitab.endTab'); ?>
        <?php endif; ?>
        <?php echo LayoutHelper::render('joomla.edit.params', $this); ?>
		<?php echo HTMLHelper::_('uitab.endTabSet'); ?>
	</div>


	<input type="hidden" name="task" value="">
	<input type="hidden" name="forcedLanguage" value="<?php echo $input->get('forcedLanguage', '', 'cmd'); ?>">
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
