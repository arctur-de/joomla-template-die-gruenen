<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.core');

$columns = 3;
$col_width = floor(12 / $columns);
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<?php if ($this->params->get('filter_field') || $this->params->get('show_pagination_limit')) : ?>
		<fieldset class="filters btn-toolbar">
			<?php if ($this->params->get('filter_field')) : ?>
				<div class="btn-group">
					<label class="filter-search-lbl element-invisible" for="filter-search">
						<span class="label label-warning">
							<?php echo JText::_('JUNPUBLISHED'); ?>
						</span>
							<?php echo JText::_('COM_CONTACT_FILTER_LABEL') . '&#160;'; ?>
					</label>
					<input
						type="text"
						name="filter-search"
						id="filter-search"
						value="<?php echo $this->escape($this->state->get('list.filter')); ?>"
						class="inputbox"
						onchange="document.adminForm.submit();"
						title="<?php echo JText::_('COM_CONTACT_FILTER_SEARCH_DESC'); ?>"
						placeholder="<?php echo JText::_('COM_CONTACT_FILTER_SEARCH_DESC'); ?>"
					/>
				</div>
			<?php endif; ?>
			<?php if ($this->params->get('show_pagination_limit')) : ?>
				<div class="btn-group pull-right">
					<label for="limit" class="element-invisible">
						<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
					</label>
					<?php echo $this->pagination->getLimitBox(); ?>
				</div>
			<?php endif; ?>
		</fieldset>
	<?php endif; ?>
	<?php if (empty($this->items)) : ?>
		<p>
			<?php echo JText::_('COM_CONTACT_NO_CONTACTS'); ?>
		</p>
	<?php else : ?>
		<div class="category">
			<div class="row">
				<?php foreach ($this->items as $i => $item) : ?>
					<div class="cat-list-item col-md-<?php echo $col_width; ?>">
						<?php if ($this->params->get('show_image_heading')) : ?>
							<?php if ($this->items[$i]->image) : ?>
								<div class="item-thumbnail">
									<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>" style="background-image: url(<?php echo $this->items[$i]->image ?>)">
									</a>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						<h3 class="item-contact item-name">
							<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>">
								<?php echo $item->name; ?>
							</a>
						</h3>
						<?php if ($item->published == 0) : ?>
							<span class="label label-warning">
								<?php echo JText::_('JUNPUBLISHED'); ?>
							</span>
						<?php endif; ?>
						<?php echo $item->event->afterDisplayTitle; ?>
						<?php echo $item->event->beforeDisplayContent; ?>

						<?php if ($this->params->get('show_position_headings')) : ?>
							<div class="item-contact item-position">
								<?php echo $item->con_position; ?>
							</div>
						<?php endif; ?>

						<?php if ($this->params->get('show_email_headings')) : ?>
							<div class="item-contact item-mail">
								<?php echo $item->email_to; ?><br />
							</div>
						<?php endif; ?>

						<?php $location = array(); ?>
						<?php if ($this->params->get('show_suburb_headings') && !empty($item->suburb)) : ?>
							<?php $location[] = $item->suburb; ?>
						<?php endif; ?>
						<?php if ($this->params->get('show_state_headings') && !empty($item->state)) : ?>
							<?php $location[] = $item->state; ?>
						<?php endif; ?>
						<?php if ($this->params->get('show_country_headings') && !empty($item->country)) : ?>
							<?php $location[] = $item->country; ?>
						<?php endif; ?>
						<?php if (count($location) > 0): ?>
							<div class="item-contact item-location">
								<?php echo implode(', ', $location); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	<!--
	<?php if ($this->params->get('show_pagination', 2)) : ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
	-->
	<div>
		<input type="hidden" name="filter_order" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->escape($this->state->get('list.direction')); ?>" />
	</div>
</form>
