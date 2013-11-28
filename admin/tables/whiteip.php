<?php
defined('_JEXEC') or die;

jimport('joomla.database.table');

class BfstopTableWhiteip extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__bfstop_whitelist', 'id', $db);
	}
}
