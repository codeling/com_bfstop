<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

use Codeling\Component\Bfstop\Administrator\Helper\LinkHelper;

foreach ($this->items as $i => $item): ?>
<tr>
	<td><?php echo $item->id; ?></td>
	<td><a href="<?php echo htmlspecialchars(LinkHelper::getIpInfoLink($item->ipaddress), ENT_QUOTES, 'UTF-8');?>"><?php echo htmlspecialchars($item->ipaddress, ENT_QUOTES, 'UTF-8'); ?></a></td>
	<td><?php echo $item->logtime; ?></td>
	<td><?php echo htmlspecialchars($item->username, ENT_QUOTES, 'UTF-8'); ?></td>
	<td><?php echo $this->getOriginName($item->origin); ?></td>
</tr>
<?php endforeach;
