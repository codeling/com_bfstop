<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;
foreach ($this->items as $i => $logline): ?>
<tr>
	<td><?php echo $logline->date; ?></td>
	<td><?php echo $logline->priority; ?></td>
	<td><?php echo $logline->message; ?></td>
</tr>
<?php endforeach;
