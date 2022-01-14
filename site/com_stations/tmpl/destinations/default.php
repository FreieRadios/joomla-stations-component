<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Language\Text;

$wa = $this->document->getWebAssetManager();
$wa->useStyle('com_stations.destinations');

?>

<div class="com-stations view-destinations <?php echo $this->pageclass_sfx; ?>">
	<div class="stations-destinations">
		<?php foreach ($this->items as $item): ?>
			<div class="stations-destination-item">
				<h2 class="stations-destination-title"><?php echo $item->name; ?></h2>
				<?php $stripedDescription = strip_tags($item->txt); ?>
				<div class="stations-destination-description"><?php echo strlen($stripedDescription) > 200 ? substr($stripedDescription, 0, 200) . '...' : $stripedDescription; ?></div>
				<a class="stations-destination-link" href="<?php echo $item->url; ?>"></a>
			</div>
		<?php endforeach ?>
	</div>
	<?php echo $this->pagination->getListFooter(); ?>

</div>