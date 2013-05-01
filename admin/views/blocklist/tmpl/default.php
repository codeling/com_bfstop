<?php
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');

?>

<form action="<?php echo JRoute::_('index.php?option=com_bfstop&view=blocklist'); ?>" method="post" name="adminForm" id="adminForm">
   <input type="hidden" name="task" value="delete" />
    <?php echo JHtml::_('form.token'); ?>
   HERE SHOULD BE THE BLOCKED IP ADDRESS LIST
</form>
