<?php
defined('_JEXEC') or die('Restricted Access');
foreach ($this->items as $i => $item): ?>
<tr>
	<td><?php echo $item->id; ?></td>
	<td><?php echo $item->ipaddress; ?></td>
	<td><?php echo $item->crdate; ?></td>
	<td><?php echo (($item->unblocked != null)
		? $item->unblocked
		: '<a href="'.$this->getUnblockLink($item->id).'">Unblock</a>')
	?></td>
</tr>
<?php endforeach;
