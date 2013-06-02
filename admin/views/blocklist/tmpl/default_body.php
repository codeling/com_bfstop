<?php
defined('_JEXEC') or die('Restricted Access');
foreach ($this->items as $i => $item): ?>
<tr>
	<td><?php echo $item->id; ?></td>
	<td><?php echo $item->ipaddress; ?></td>
	<td><?php echo $item->crdate; ?></td>
	<td><?php echo $this->convertDurationToReadable($item->duration); ?></td>
	<td><?php echo (($item->unblocked != null)
		? JText::sprintf('UNBLOCKED_STATE', $item->unblocked)
		: (JText::_('STILL_BLOCKED').
			' <a href="'.$this->getUnblockLink($item->id).'">'.
			JText::_('UNBLOCK_LINK_CAPTION').'</a>'))
	?></td>
</tr>
<?php endforeach;
