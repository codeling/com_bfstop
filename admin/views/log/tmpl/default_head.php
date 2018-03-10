<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2017 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;
?>
<tr>
	<th width="20">
		<input
			type="checkbox"
			name="toggle"
			value=""
			onclick="checkAll(<?php echo count($this->items); ?>);"
		/>
	</th>
	<th><?php echo JText::_('COM_BFSTOP_HEADING_DATE'); ?></th>
	<th><?php echo JText::_('COM_BFSTOP_HEADING_PRIORITY'); ?></th>
	<th><?php echo JText::_('COM_BFSTOP_HEADING_MESSAGE'); ?></th>
</tr>

