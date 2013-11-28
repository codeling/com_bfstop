<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class BfstopControllerwhiteip extends JControllerForm
{
	public function save($key = null, $urlVar = null)
	{
		$return = parent::save($key, $urlVar);
		$this->setRedirect('index.php?option=com_bfstop&view=whitelist', $msg);
		return $return;
	}
	public function cancel($key = null)
	{
		$return = parent::cancel($key);
		$this->setRedirect('index.php?option=com_bfstop&view=whitelist');
		return $return;
	}

}
