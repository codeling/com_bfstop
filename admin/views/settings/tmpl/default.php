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
	<input type="hidden" name="task" value="settings.testNotify" />
	<?php echo JHtml::_('form.token'); ?>
	<div class="row">
<?php if (isset($this->sidebar)) { ?>
		<div id="j-sidebar-container" class="span2 col-md-2">
			<?php echo $this->sidebar; ?>
		</div>
<?php } ?>
		<div id="j-main-container" class="span10 j-toggle-main col-md-10">
			<div class="message" >
				<?php echo JText::_('SETTINGS_VIEW_HINT'); ?>
			</div>
		</div>
	</div>
</form>
