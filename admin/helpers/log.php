<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

$ds = DIRECTORY_SEPARATOR;
$dbhelper  = JPATH_SITE.$ds.'plugins'.$ds.'system'.$ds.'bfstop'.$ds.'helpers'.$ds.'db.php';
$loghelper = JPATH_SITE.$ds.'plugins'.$ds.'system'.$ds.'bfstop'.$ds.'helpers'.$ds.'log.php';

function getLogger()
{
	$plugin = JPluginHelper::getPlugin('system', 'bfstop');
	$params = new JRegistry($plugin->params);
	$loglevel = $params->get('logLevel', JLog::ERROR);
	return new BFStopLogger($loglevel);
}
