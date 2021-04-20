<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

class BFStopLinkHelper
{
	public static function getIpInfoLink($ipaddress)
	{
		$input = JFactory::getApplication()->input;
		$menuId = $input->get('Itemid', 0, 'INTEGER');
		$link = 'index.php?option=com_bfstop&Itemid='.$menuId.'&view=ipinfo&ipaddress='.$ipaddress;
		return $link;
	}
}
