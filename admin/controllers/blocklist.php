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

	function unblock()
	{
		$logger = new BFStopLogger(true);
		$input =  JFactory::getApplication()->input;
		$ids = $input->post->get('cid', array(), 'array');
		JArrayHelper::toInteger($ids);
		$model = $this->getModel('blocklist');
		$message = $model->unblock($ids, $logger);
		$application = JFactory::getApplication();
		$application->enqueueMessage($message);
		// redirect to blocklist view
		$view = $this->getView('blocklist', 'html');
		$view->setModel($model, true);
		$view->display();
	}
}
