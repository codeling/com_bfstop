<?php
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
?>
<form method="post" name="adminForm" id="block-form">
	<fieldset class="adminform">
		<legend><?php echo JText::_('COM_BFSTOP_BLOCK_DETAILS'); ?></legend>
		<ul class="adminformlist">
<?php foreach($this->form->getFieldset() as $field): ?>
			<li><?php echo $field->label; echo $field->input; ?></li>
<?php endforeach; ?>
		</ul>
	</fieldset>
	<input type="hidden" name="task" value="block.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>
