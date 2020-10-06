
<?php

/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2018 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

$user = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
$canOrder = $user->authorise('core.edit.state','com_sppolls');
$saveOrder = ($listOrder == 'a.ordering');
if($saveOrder) {
	$saveOrderingUrl = 'index.php?option=com_sppolls&task=polls.saveOrderAjax&tmpl=component';
	$html = JHtml::_('sortablelist.sortable', 'pollList','adminForm', strtolower($listDirn),$saveOrderingUrl);
}
JHtml::_('jquery.framework', false);
?>

<script type="text/javascript">
    Joomla.orderTable = function() {
        table = document.getElementById('sortTable');
        direction = document.getElementById('directionTable');
        order = table.options[table.selectedIndex].value;
        if (order != '<?php echo $listOrder; ?>') {
            dirn = 'asc';
        } else {
            dirn = direction.options[direction.selectedIndex].value;
        }
        Joomla.tableOrdering(order, dirn, '');
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_sppolls&view=polls'); ?>" method="POST" name="adminForm" id="adminForm">

	<?php if (!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>

	<div id="j-main-container" class="span10" >
		<?php else: ?>
			<div id="j-main-container"></div>
		<?php endif; ?>

		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
		<div class="clearfix"></div>

		<table class="table table-striped" id="pollList">
			<thead>
				<tr>
					<th class="nowrap center hidden-phone" width="1%">
						<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
					</th>

					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>

					<th width="1%" class="nowrap center">
						<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
					</th>

					<th>
						<?php echo JHtml::_('grid.sort','JGLOBAL_TITLE','a.title',$listDirn,$listOrder); ?>
					</th>

					<th>
						<?php echo JHtml::_('grid.sort', 'COM_SPPOLLS_POLLS', 'a.polls' , $listDirn, $listOrder); ?>
					</th>

					<th>
						<?php echo JHtml::_('grid.sort', 'COM_SPPOLLS_POLLS_CREATED_LABEL', 'a.created', $listDirn, $listOrder); ?>
					</th>

					<th>
						<?php echo JHtml::_('grid.sort', 'COM_SPPOLLS_LANGUAGE', 'a.language', $listDirn, $listOrder); ?>
					</th>
					
				</tr>
			</thead>

			<tfoot>
				<tr>
					<td colspan="10">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>

			<tbody>
				<?php foreach($this->items as $i => $item): ?>

					<?php
					$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;
					$canChange = $user->authorise('core.edit.state', 'com_sppolls') && $canCheckin;
					$canEdit = $user->authorise( 'core.edit', 'com_sppolls' );
					?>

					<tr class="row<?php echo $i % 2; ?>" sortable-group-id="1">
						<td class="order nowrap center hidden-phone">
							<?php if($canChange) :
								$disableClassName = '';
								$disabledLabel = '';
								if(!$saveOrder) :
									$disabledLabel = JText::_('JORDERINGDISABLED');
									$disableClassName = 'inactive tip-top';
								endif;
								?>

								<span class="sortable-handler hasTooltip <?php echo $disableClassName; ?>" title="<?php echo $disabledLabel; ?>">
									<i class="icon-menu"></i>
								</span>
								<input type="text" style="display: none;" name="order[]" size="5" class="width-20 text-area-order " value="<?php echo $item->ordering; ?>" >
							<?php else: ?>
								<span class="sortable-handler inactive">
									<i class="icon-menu"></i>
								</span>
							<?php endif; ?>
						</td>

						<td class="center hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>

						<td class="center">
							<?php echo JHtml::_('jgrid.published', $item->published, $i, 'polls.', true,'cb');?>
						</td>

						<td>
							<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('jgrid.checkedout', $i,$item->created_by, $item->checked_out_time, 'polls.', $canCheckin); ?>
							<?php endif; ?>

							<?php if ($canEdit) : ?>
								<a class="title" href="<?php echo JRoute::_('index.php?option=com_sppolls&task=poll.edit&id='. $item->id); ?>">
									<?php echo $this->escape($item->title); ?>
								</a>
							<?php else : ?>
								<?php echo $this->escape($item->title); ?>
							<?php endif; ?>

							<span class="small break-word">
								<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias)); ?>
							</span>
						</td>

						<td>
							<?php echo $item->cpolls['count'] . "<small> (" . $item->cpolls['votes'] . ($item->cpolls['votes'] > 1 ? ' Votes' : ' Vote') . ")</small>"; ?>
						</td>

						<td>
							<?php echo date_format(new DateTime($item->created), 'd M, Y'); ?>
						</td>

						<td>
							<?php echo $item->language == '*' ? 'English (United Kingdom)' : $item->lang; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $lilstDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
	
