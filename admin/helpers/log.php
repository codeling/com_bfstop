<?php
require_once(JPATH_SITE.DIRECTORY_SEPARATOR.'plugins'
                .DIRECTORY_SEPARATOR.'system'
                .DIRECTORY_SEPARATOR.'bfstop'
                .DIRECTORY_SEPARATOR.'helpers'
                .DIRECTORY_SEPARATOR.'db.php');
require_once(JPATH_SITE.DIRECTORY_SEPARATOR.'plugins'
                .DIRECTORY_SEPARATOR.'system'
                .DIRECTORY_SEPARATOR.'bfstop'
                .DIRECTORY_SEPARATOR.'helpers'
                .DIRECTORY_SEPARATOR.'log.php');

function getLogger()
{
	$plugin = JPluginHelper::getPlugin('system', 'bfstop');
	$params = new JRegistry($plugin->params);
	$loglevel = $params->get('logLevel', JLog::ERROR);
	return new BFStopLogger($loglevel);
}
