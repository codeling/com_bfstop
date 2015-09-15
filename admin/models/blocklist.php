<?php
/*
 * @package Brute Force Stop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2014 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
require_once(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'helpers'.
		DIRECTORY_SEPARATOR.'unblock.php');

require_once(JPATH_SITE.DIRECTORY_SEPARATOR.'plugins'
				.DIRECTORY_SEPARATOR.'system'
				.DIRECTORY_SEPARATOR.'bfstop'
				.DIRECTORY_SEPARATOR.'helpers'
				.DIRECTORY_SEPARATOR.'htaccess.php');

class bfstopModelblocklist extends JModelList
{

	protected $cachedHtaccessLines = null;

	private function getHtAccessLines()
	{
		if (is_null($this->cachedHtAccessLines))
		{
			$this->cachedHtAccessLines = array();
			$htaccess = new BFStopHtAccess( null);
		#	$this->logger->log('Blocking '.$logEntry->ipaddress.' through '.$htaccess->getFileName(), JLog::INFO);
			$deniedIPs = $htaccess->getDeniedIPs();
			foreach($deniedIPs as $ip)
			{
				$htaccessEntry = new stdClass();
				$htaccessEntry->id = $ip;
				$htaccessEntry->ipaddress = $ip;
				$htaccessEntry->crdate = 'unknown';
				$htaccessEntry->duration = 0;
				$htaccessEntry->unblocked = null;
				$htaccessEntry->source = '.htaccess';
				$this->cachedHtAccessLines[] = $htaccessEntry;
			}
		}
		return $this->cachedHtAccessLines;
	}

	public function __construct($config = array())
	{
		$config['filter_fields'] = array(
			'b.id',
			'b.ipaddress',
			'b.crdate',
			'b.duration',
			'unblocked'
		);
		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('b.id, b.ipaddress, b.crdate, b.duration, u.crdate as unblocked, \'database\' as source');
		$query->from('#__bfstop_bannedip b left join #__bfstop_unblock u on b.id=u.block_id');
		$ordering  = $this->getState('list.ordering', 'b.id');
		$ordering  = (strcmp($ordering, '') == 0) ? 'b.id' : $ordering;
		$direction = $this->getState('list.direction', 'ASC');
		$direction = (strcmp($direction, '') == 0) ? 'ASC' : $direction;
		$query->order($db->escape($ordering).' '.$db->escape($direction));
		return $query;
	}

	public function getItems()
	{
		$result = parent::getItems(); // we don't need a logger here
		if ( ($this->getStart() + $this->getState('list.limit')) > parent::getTotal())
		{
			$sizeAlready = count($result);
			$result = array_merge($result, array_slice($this->getHtAccessLines(), 
				max(0, $this->getStart() - parent::getTotal()), 
				$this->getState('list.limit') - $sizeAlready));
		}
		return $result;
	}

	protected function populateState($ordering = null, $direction = null) {
		parent::populateState('b.id', 'ASC');
	}

	public function unblock($ids, $logger)
	{
		if (BFStopUnblockHelper::unblock(JFactory::getDBO(), $ids, 0, $logger)) {
			return JText::_("UNBLOCK_SUCCESS");
		} else {
			return JText::_("UNBLOCK_FAILED");
		}
	}

	public function getTotal()
	{
		return parent::getTotal() + count($this->getHtAccessLines());
	}
}
