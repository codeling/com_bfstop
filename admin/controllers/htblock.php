<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

require_once(JPATH_ADMINISTRATOR.'/components/com_bfstop/helpers/params.php');
$pluginHelperDir = JPATH_SITE.'/plugins/system/bfstop/helpers/';
require_once($pluginHelperDir.'htaccess.php');
require_once($pluginHelperDir.'db.php');

class BFStopControllerHTBlock extends JControllerForm
{
	public function add()
	{
		$this->setRedirect(
			JRoute::_('index.php?option=com_bfstop&view=htblock', false)
		);
		return true;	
	}

	public function returnToFormWithMessage($ipaddress, $msg)
	{
		$application = JFactory::getApplication();
		$formdata = array("ipaddress" => $ipaddress);
		$application->setUserState('com_bfstop.edit.htblock.data', $formdata);
		$application->enqueueMessage($msg, 'warning');
		$this->setRedirect(
			JRoute::_('index.php?option=com_bfstop&view=htblock', false)
		);
	}
	public function save($key = null, $urlVar = null)
	{
		$logger = getLogger();
		$htaccessPath = BFStopParamHelper::get('htaccessPath', 'params', JPATH_ROOT);
		$htaccessPath = $htaccessPath === "" ? JPATH_ROOT : $htaccessPath;
		$htaccess = new BFStopHtAccess($htaccessPath, null);
		$input = JFactory::getApplication()->input;
		$formData = new JRegistry($input->get('jform', array(), 'array'));
		$ipaddress = $formData->get('ipaddress', '');
		$db = new BFStopDBHelper($logger);
		if ($db->isIPOnAllowList($ipaddress))
		{
			$logger->log("IP address '$ipaddress' is on allow list! Will not block it via .htaccess", JLog::INFO);
			$this->returnToFormWithMessage($ipaddress, JText::_('COM_BFSTOP_IPADDRESS_ALLOWED'));
			return false;
		}
		$result = $htaccess->denyIP($ipaddress);
		if ($result)
		{
			$logger->log("Added ipaddress '$ipaddress' to .htaccess from backend", JLog::INFO);
			$this->setRedirect(
				JRoute::_('index.php?option=com_bfstop&view=htblocklist', false)
			);
		}
		else
		{
			$this->returnToFormWithMessage($ipaddress, JText::_('COM_BFSTOP_INVALID_IPADDRESS'));
		}
		return $result;
	}
	public function cancel($key = null)
	{
		$application = JFactory::getApplication();
		$application->setUserState('com_bfstop.edit.htblock.data', array());
		$this->setRedirect(
			JRoute::_('index.php?option=com_bfstop&view=htblocklist',false)
		);
	}

}
