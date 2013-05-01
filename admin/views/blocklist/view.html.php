<?php
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class bfstopViewblocklist extends JView
{
	function display($tpl = null) {
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// $this->addToolBar();
		// $this->setDocument();
		parent::display($tpl);
	}

	function getUnblockLink($id)
	{
		return "index.php?option=com_bfstop&task=unblock&id=$id";
	}
/*
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_BFSTOP_ADMIN'), 'bfstp');
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_bfstop');
	}

	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_BFSTOP_ADMIN'));
	}
*/
}
