<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ContentHelper;

class BFStopHelper extends ContentHelper
{
	private static function addEntry($jtextName, $viewName, $curView)
	{
		JHtmlSidebar::addEntry(
			JText::_($jtextName),
			'index.php?option=com_bfstop&view='.$viewName,
			$curView == $viewName
		);
	}
	public static function addSubmenu($vName, $htaccess=true)
	{
		self::addEntry('COM_BFSTOP_SUBMENU_BLOCKLIST', 'blocklist', $vName);
		if ($htaccess)
		{
			self::addEntry('COM_BFSTOP_SUBMENU_HTACCESS_BLOCKLIST', 'htblocklist', $vName);
		}
		self::addEntry('COM_BFSTOP_SUBMENU_ALLOWLIST', 'allowlist', $vName);
		self::addEntry('COM_BFSTOP_SUBMENU_FAILEDLOGINLIST', 'failedloginlist', $vName);
		self::addEntry('COM_BFSTOP_SUBMENU_SETTINGS', 'settings', $vName);
		self::addEntry('COM_BFSTOP_SUBMENU_LOGS', 'log', $vName);
	}
}
