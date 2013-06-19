<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');
require_once(JPATH_SITE.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.
                'bfstop'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'log.php');

class BfstopControllerBlockList extends JControllerAdmin
{
	public function getModel($name = 'blocklist', $prefix = 'bfstopmodel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
