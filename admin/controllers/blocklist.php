<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class BfstopControllerBlockList extends JControllerAdmin
{
	public function getModel($name = 'blocklist', $prefix = 'bfstopmodel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	function unblock()
	{
		$logger = getLogger();
		$input =  JFactory::getApplication()->input;
		$ids = $input->post->get('cid', array(), 'array');
		JArrayHelper::toInteger($ids);
		$model = $this->getModel('blocklist');
		$message = $model->unblock($ids, $logger);
		// redirect to blocklist view
                $this->setRedirect(JRoute::_('index.php?option=com_bfstop&view=blocklist',false),
                        $message, 'notice');
	}
}
