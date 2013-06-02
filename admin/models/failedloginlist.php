<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class bfstopModelfailedloginlist extends JModelList
{
	public function __construct($config = array())
	{
		$config['filter_fields'] = array(
			'l.id',
			'l.username',
			'l.ipaddress',
			'l.error',
			'l.logtime',
			'l.origin'
		);
		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('l.id, l.username, l.ipaddress, l.error, l.logtime, l.origin');
		$query->from('#__bfstop_failedlogin l');
		$query->order($db->getEscaped($this->getState('list.ordering', 'l.id')).' '.
			$db->getEscaped($this->getState('list.direction', 'ASC')));
		return $query;
	}

	protected function populateState($ordering = null, $direction = null) {
		parent::populateState('l.id', 'ASC');
	}
}
