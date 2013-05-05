<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
jimport('joomla.utilities.date');
jimport('plugins.system.bfstop.helper_log');

class bfstopViewtokenunblock extends JView {

	function display($tpl = null) {
		$this->model = $this->getModel();
		$input = JFactory::getApplication()->input;
		$token = $input->getString('token', '');
		$logger = new BFStopLogger(true);
		if (strcmp($token, '') != 0) {
			$unblockSuccess = $this->model->unblock($token, $logger);
			$this->message = ($unblockSuccess)
				? 'Unblocking successful! Helpful links: Reset password: ... Login: ...'
				: 'Could not unblock.';
		} else {
			$this->message = 'Invalid call.';
		}
		parent::display($tpl);
	}
}

