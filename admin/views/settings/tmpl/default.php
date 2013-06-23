<div class="message" >
<?php echo JText::_('SETTINGS_VIEW_HINT'); ?>
</div>
<form method="post" name="adminForm" id="adminForm">
	<input type="hidden" name="task" value="settings.testNotify" />
	<?php echo JHtml::_('form.token'); ?>
</form>
