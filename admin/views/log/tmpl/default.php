<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;
?>
<form method="post" name="adminForm" id="adminForm">
	<input type="hidden" name="task" value="unblock" />
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
	<input type="hidden" name="boxchecked" value="0" />
	<div class="row">
<?php if (isset($this->sidebar)) { ?>
		<div id="j-sidebar-container" class="span2 col-md-2">
			<?php echo $this->sidebar; ?>
		</div>
<?php } ?>
		<div id="j-main-container" class="span10 j-toggle-main col-md-10">
			<table class="adminlist table table-striped">
				<thead><?php echo $this->loadTemplate('head'); ?></thead>
				<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
				<tbody><?php echo $this->loadTemplate('body');?></tbody>
			</table>
		</div>
	</div>
</form>
