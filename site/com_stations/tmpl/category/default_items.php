<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_stations
 *
 * @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2005 - 2022 Open Source Matters, Inc. All rights reserved.
 */

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Stations\Site\Helper\RouteHelper;

HTMLHelper::_('behavior.core');
$category = "";
$start = true;
?>
<div class="com-stations-category__items">
    <form action="<?php echo htmlspecialchars(Uri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">
        <?php if (empty($this->items)) : ?>
            <p>
                <?php echo Text::_('JGLOBAL_SELECT_NO_RESULTS_MATCH'); ?>
            </p>
        <?php else : ?>

                <?php foreach ($this->items as $i => $item) : ?>

                   <?php if ($category != $item->category_title): ?>
                 <?php if(!$start) : ?></ul><?php endif; $start = false; ?>
                            <h3><?php echo $item->category_title ?></h3>
                            <ul class="com-station-category__list category">
                        <?php endif; ?>


                        <li class="row cat-list-row" >

                            <div class="list-title">
                                <h4><?php echo $item->name; ?></h4>

                            </div>
                            <div class="list-item">
                            <?php echo $item->address; ?><br />
                            <?php echo $item->zipcode; ?> <?php echo $item->town; ?><br />
                            <a class="stations-url" href="<?php echo $item->url; ?>"><?php echo $item->www; ?></a><br />
                            <?php echo $item->mhz ?> MHz
                             <br /><br />
                            <?php echo $item->event->afterDisplayContent; ?>
                            </div>
                        </li>
                <?php $category = $item->category_title; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if ($this->params->get('show_pagination', 2)) : ?>
            <div class="com-station-category__counter">
                <?php if ($this->params->def('show_pagination_results', 1)) : ?>
                    <p class="counter">
                        <?php echo $this->pagination->getPagesCounter(); ?>
                    </p>
                <?php endif; ?>

                <?php echo $this->pagination->getPagesLinks(); ?>
            </div>
        <?php endif; ?>
    </form>
</div>
<?php $this->children = false; ?>