<?php
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class bfstopViewfailedloginlist extends JViewLegacy
{
	function display($tpl = null) {
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		parent::display($tpl);
	}
	function getOriginName()
	{
		
	}
}
