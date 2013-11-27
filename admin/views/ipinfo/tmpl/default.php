<?php
defined('_JEXEC') or die;
?>
<h1><?php echo JText::sprintf('IPINFO_CAPTION', $this->ipAddress); ?></h1>
<div>
	<?php echo $this->ipInfo; ?>
</div>
