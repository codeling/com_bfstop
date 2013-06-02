<?php
defined('_JEXEC') or die('Restricted Access');
?>
<tr class="sortable">
	<th>
		<?php echo JHTML::_('grid.sort',
			JText::_('COM_BFSTOP_HEADING_ID'),
			'b.id',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
	<th>
		<?php echo JHTML::_('grid.sort',
			JText::_('COM_BFSTOP_HEADING_IPADDRESS'),
			'b.ipaddress',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
	<th>
		<?php echo JHTML::_('grid.sort',
			JText::_('COM_BFSTOP_HEADING_DATE'),
			'b.crdate',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
	<th>
		<?php echo JHTML::_('grid.sort',
			JText::_('COM_BFSTOP_HEADING_STATE'),
			'unblocked',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
</tr>
