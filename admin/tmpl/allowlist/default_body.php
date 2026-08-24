<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

use Codeling\Component\Bfstop\Administrator\Helper\IpRangeHelper;
use Codeling\Component\Bfstop\Administrator\Helper\LinkHelper;
use Joomla\CMS\HTML\HTMLHelper;

foreach ($this->items as $i => $item): ?>
<tr>
	<td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
	<td><?php echo $item->id; ?></td>
	<td><a href="<?php echo htmlspecialchars(LinkHelper::getIpInfoLink($item->ipaddress), ENT_QUOTES, 'UTF-8');?>"><?php echo htmlspecialchars($item->ipaddress, ENT_QUOTES, 'UTF-8'); ?></a></td>
	<td><?php if (str_contains($item->ipaddress, "/")) { $rng = IpRangeHelper::cidrToRange($item->ipaddress); echo(htmlspecialchars($rng[0]."-".$rng[1]." (".IpRangeHelper::numOfAddresses($item->ipaddress).")", ENT_QUOTES, 'UTF-8')); } ?></td>
	<td><?php echo htmlspecialchars($item->notes, ENT_QUOTES, 'UTF-8'); ?></td>
</tr>
<?php endforeach;
