<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');

class bfstopModelblocklist extends JModelList
{
	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('b.id, b.ipaddress, b.crdate, u.crdate as unblocked');
		$query->from('#__bfstop_bannedip b left join #__bfstop_unblock u on b.id=u.block_id');
		//$query->setQuery('SELECT id, ipaddress, crdate FROM #__bfstop_bannedip ');
		return $query;
	}
}
