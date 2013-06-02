<?php
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');

?>
	<table class="adminlist">
		<thead><?php echo $this->loadTemplate('head'); ?></thead>
		<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
		<tbody><?php echo $this->loadTemplate('body');?></tbody>
	</table>
