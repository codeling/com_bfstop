<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

class BFStopParamHelper
{
	public static function get($name, $column, $defaultValue)
	{
		$db = JFactory::getDbo();
		$sql = "SELECT $column FROM #__extensions WHERE name = 'plg_system_bfstop'";
		$db->setQuery($sql);
		$rawSettings = $db->loadResult();
		$settings = json_decode($rawSettings, true);
		return array_key_exists($name, $settings) ? $settings[$name] : $defaultValue ;
	}
}

