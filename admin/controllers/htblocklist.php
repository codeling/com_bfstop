<?php
/*
 * @package Brute Force Stop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2014 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class BfstopControllerhtblocklist extends JControllerAdmin
{
	public function getModel($name = 'htblocklist', $prefix = 'bfstopmodel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	function unblock()
	{
		$logger = getLogger();
		$input =  JFactory::getApplication()->input;
		$ips = $input->post->get('cid', array(), 'array');
		$model = $this->getModel('htblocklist');
		$message = $model->unblock($ips, $logger);
		// redirect to htblocklist view
		$this->setRedirect(JRoute::_('index.php?option=com_bfstop&view=htblocklist',false),
			$message, 'notice');
	}
}
