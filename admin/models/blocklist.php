<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');
require_once(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'helpers'.
		DIRECTORY_SEPARATOR.'unblock.php');

class bfstopModelblocklist extends JModelList
{
	public function __construct($config = array())
	{
		$config['filter_fields'] = array(
			'b.id',
			'b.ipaddress',
			'b.crdate',
			'unblocked'
		);
		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('b.id, b.ipaddress, b.crdate, u.crdate as unblocked');
		$query->from('#__bfstop_bannedip b left join #__bfstop_unblock u on b.id=u.block_id');
		$query->order($db->getEscaped($this->getState('list.ordering', 'b.id')).' '.
			$db->getEscaped($this->getState('list.direction', 'ASC')));
		return $query;
	}

	protected function populateState($ordering = null, $direction = null) {
		parent::populateState('b.id', 'ASC');
	}

	public function unblock($id, $logger)
	{
		if ($id <= 0) {
			$logger->log("Invalid ID ($id)!");
			return JText::sprintf("UNBLOCK_INVALIDID", $id);
		}
		if (BFStopUnblockHelper::unblock(JFactory::getDBO(), $id, 0, $logger)) {
			return JText::_("UNBLOCK_SUCCESS");
		} else {
			return JText::_("UNBLOCK_FAILED");
		}
	}
}
