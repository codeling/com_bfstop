<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
jimport('joomla.utilities.date');

class bfstopViewtokenunblock extends JViewLegacy {

	function getLoginLink() {
		return JRoute::_('index.php?option=com_users&view=login');
	}

	function getPasswordResetLink() {
		return JRoute::_('index.php?option=com_users&view=reset');
	}

	function display($tpl = null) {
		// clear the messages still enqueued from the invalid login attempt:
		$session = JFactory::getSession();
		$session->set('application.queue', null);
		// try to unblock:
		$input = JFactory::getApplication()->input;
		$token = $input->getString('token', '');
		$logger = new BFStopLogger(true);
		if (strcmp($token, '') != 0) {
			$this->model = $this->getModel();
			$unblockSuccess = $this->model->unblock($token, $logger);
			$this->message = ($unblockSuccess)
				? JText::sprintf('UNBLOCKTOKEN_SUCCESS',
					$this->getLoginLink(),
					$this->getPasswordResetLink())
				: JText::_('UNBLOCKTOKEN_FAILED');
		} else {
			$this->message = JText::_('UNBLOCKTOKEN_INVALID');
		}
		parent::display($tpl);
	}
}

