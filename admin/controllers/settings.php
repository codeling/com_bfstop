<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class BfstopControllerSettings extends JControllerAdmin
{
	private function getParam($name, $column, $defaultValue) {
		$db = JFactory::getDbo();
		$sql = "SELECT $column FROM #__extensions WHERE name = 'plg_system_bfstop'";
		$db->setQuery($sql);
		$rawSettings = $db->loadResult();
		$settings = json_decode($rawSettings, true);
		return array_key_exists($name, $settings) ? $settings[$name] : $defaultValue ;
	}

	public function getModel($name = 'settings', $prefix = 'bfstopmodel', $config=array())
	{
		$config['ignore_request'] = true;
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	public function testNotify()
	{
		$emailAddress = $this->getParam('emailaddress', 'params', '');
		$emailType = $this->getParam('emailtype', 'params', '');
		$userIDs = $this->getParam('userIDs', 'params', '');
		$logger = getLogger();
		$db  = new BFStopDBHelper($logger);
		$notifier = new BFStopNotifier($logger, $db,
			(int)$emailType,
			$emailAddress,
			$userIDs);
		$subject = JText::sprintf('TEST_MAIL_SUBJECT', $notifier->getSiteName());
		$body = JText::sprintf('TEST_MAIL_BODY', $notifier->getSiteName());
		$application = JFactory::getApplication();
		$application->enqueueMessage(JText::sprintf("TEST_MAIL_SENT",
				$subject,
				$body,
				$notifier->getNotifyAddress()),
			'notice');
		$result = $notifier->sendMail($subject, $body, $notifier->getNotifyAddress());

		// redirect back to settings view:
		$this->setRedirect(JRoute::_('index.php?option=com_bfstop&view=settings',false),
			$result
				? JText::_('TEST_NOTIFICATION_SUCCESS')
				: JText::_('TEST_NOTIFICATION_FAILED'),
			$result
				? 'notice'
				: 'error'
		);
	}
}
