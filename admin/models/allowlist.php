<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class BFStopModelAllowList extends JModelList
{
	public function __construct($config = array())
	{
		$config['filter_fields'] = array(
			'a.id',
			'a.ipaddress',
			'a.notes'
		);
		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('a.id, a.ipaddress, a.notes');
		$query->from('#__bfstop_allowlist a');
		$ordering  = $this->getState('list.ordering', 'a.id');
		$ordering  = (strcmp($ordering, '') == 0) ? 'a.id' : $ordering;
		$direction = $this->getState('list.direction', 'ASC');
		$direction = (strcmp($direction, '') == 0) ? 'ASC' : $direction;
		$query->order($db->escape($ordering).' '.$db->escape($direction));
		return $query;
	}

	protected function populateState($ordering = null, $direction = null) {
		parent::populateState('a.id', 'ASC');
	}

	public function remove($ids, $logger)
	{
		try {
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$conditions = array(
				$db->quoteName('id').' IN ('.implode(", ", $ids).')'
			);
			$query->delete($db->quoteName('#__bfstop_allowlist'));
			$query->where($conditions);
			$db->setQuery($query);
			$db->execute();
		} catch (RuntimeException $e) {
			$logger->log($e->getMessage(), JLog::ERROR);
		}
	}

}
