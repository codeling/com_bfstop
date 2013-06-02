<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class bfstopModelfailedloginlist extends JModelList
{
	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('l.id, l.username, l.ipaddress, l.error, logtime, l.origin');
		$query->from('#__bfstop_failedlogin l');
		return $query;
	}
}
