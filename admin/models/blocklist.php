<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');

class bfstopModelblocklist extends JModelList
{
	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id, ipaddress, crdate');
		$query->from('#__bfstop_bannedip');
		return $query;
	}
}
