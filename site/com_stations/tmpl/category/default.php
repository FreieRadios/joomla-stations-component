<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
?>

<div class="com-stations-category">
    <?php
    $this->subtemplatename = 'items';
    $this->maxLevel = 0;
    echo LayoutHelper::render('joomla.content.category_default', $this);
    ?>
</div>
