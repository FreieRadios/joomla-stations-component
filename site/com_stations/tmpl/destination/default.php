<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 * 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted Direct Access!');

$wa = $this->document->getWebAssetManager();
$wa->useStyle('com_stations.destinations');

?>

<div class="com-stations view-destination stations-destination-details <?php echo $this->pageclass_sfx; ?>">
	<h2 class="stations-destination-title"><?php echo $this->item->name; ?></h2>
	<div class="stations-destination-description"><?php echo $this->item->txt; ?></div>

</div>