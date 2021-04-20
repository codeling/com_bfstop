<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;
?>
	<tr>
		<td colspan="4">
			<?php echo JText::_('COM_BFSTOP_LIMIT').$this->pagination->getLimitBox(); ?>
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tr>
