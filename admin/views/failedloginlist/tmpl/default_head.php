<?php
defined('_JEXEC') or die('Restricted Access');
?>
<tr class="sortable">
	<th>
		<?php echo JHTML::_('grid.sort',
			'COM_BFSTOP_HEADING_ID',
			'l.id',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
	<th>
		<?php echo JHTML::_('grid.sort',
			'COM_BFSTOP_HEADING_IPADDRESS',
			'l.ipaddress',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
	<th>
		<?php echo JHTML::_('grid.sort',
			'COM_BFSTOP_HEADING_DATE',
			'l.logtime',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
	<th>
		<?php echo JHTML::_('grid.sort',
			'COM_BFSTOP_HEADING_USERNAME',
			'l.username',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
	<th>
		<?php echo JHTML::_('grid.sort',
			'COM_BFSTOP_HEADING_ERROR',
			'l.error',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
	<th>
		<?php echo JHTML::_('grid.sort',
			'COM_BFSTOP_HEADING_ORIGIN',
			'l.origin',
			$this->sortDirection,
			$this->sortColumn); ?>
	</th>
</tr>
