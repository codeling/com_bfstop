<?php
/*
 * @package Brute Force Stop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2014 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;
foreach ($this->items as $i => $ipaddress): ?>
<tr>
	<td><?php echo JHtml::_('grid.id', $i, $ipaddress); ?></td>
	<td><a href="<?php echo BFStopLinkHelper::getIpInfoLink($ipaddress);?>"><?php echo $ipaddress; ?></a></td>
</tr>
<?php endforeach;
