<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

namespace Codeling\Component\Bfstop\Administrator\Controller;

defined('_JEXEC') or die;

use Codeling\Component\Bfstop\Administrator\Helper\LogHelper;
use Codeling\Component\Bfstop\Administrator\Helper\ParamHelper;
use Codeling\Plugin\System\Bfstop\Helper\DatabaseHelper;
use Codeling\Plugin\System\Bfstop\Helper\NotifierHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;

class SettingsController extends AdminController
{
	public function getModel($name = 'settings', $prefix = 'bfstopmodel', $config = array())
	{
		$config['ignore_request'] = true;
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	public function testNotify()
	{
		$emailAddress = ParamHelper::get('emailaddress', 'params', '');
		$userID = (int) ParamHelper::get('userID', 'params', -1);
		$userGroup = (int) ParamHelper::get('userGroup', 'params', -1);
		$groupNotifEnabled = (bool) ParamHelper::get('groupNotificationEnabled', 'params', false);
		$logger = LogHelper::getLogger();
		$db = new DatabaseHelper($logger);
		$notifier = new NotifierHelper($logger, $db,
			$emailAddress,
			$userID,
			$userGroup,
			$groupNotifEnabled);
		if (count($notifier->getNotifyAddresses()) == 0)
		{
			$result = false;
		}
		else
		{
			$subject = Text::sprintf('TEST_MAIL_SUBJECT', $notifier->getSiteName());
			$body = Text::sprintf('TEST_MAIL_BODY', $notifier->getSiteName());
			$result = $notifier->sendMail($subject, $body, $notifier->getNotifyAddresses());
		}
		$success = ($result === true);
		// redirect back to settings view:
		$this->setRedirect(Route::_('index.php?option=com_bfstop&view=settings', false),
			$success
				? Text::_('TEST_NOTIFICATION_SUCCESS')
				: Text::sprintf('TEST_NOTIFICATION_FAILED', $result),
			$result
				? 'notice'
				: 'error'
		);
	}
}
