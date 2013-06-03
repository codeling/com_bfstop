<?php
defined('_JEXEC') or die;

jimport('joomla.database.table');

class BfstopTableBlock extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__bfstop_bannedip', 'id', $db);
	}
}
