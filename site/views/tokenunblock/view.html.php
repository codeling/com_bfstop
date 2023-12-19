<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView;

require_once(JPATH_ADMINISTRATOR.'/components/com_bfstop/helpers/log.php');

class BFStopViewTokenUnblock extends HtmlView {

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
		$logger = getLogger();
		if (strcmp($token, '') != 0) {
			$this->model = $this->getModel();
			$unblockSuccess = $this->model->unblock($token, $logger);
			$this->message = ($unblockSuccess)
				? Text::sprintf('UNBLOCKTOKEN_SUCCESS',
					$this->getLoginLink(),
					$this->getPasswordResetLink())
				: Text::_('UNBLOCKTOKEN_FAILED');
		} else {
			$this->message = Text::_('UNBLOCKTOKEN_INVALID');
		}
		parent::display($tpl);
	}
}

