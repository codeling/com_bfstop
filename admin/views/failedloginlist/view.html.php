<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

// import Joomla view library
jimport('joomla.application.component.view');

require_once(JPATH_ADMINISTRATOR.'/components/com_bfstop/helpers/links.php');

class BFStopViewFailedLoginList extends JViewLegacy
{
	function display($tpl = null)
	{
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$state            = $this->get('State');
		$this->sortColumn = $state->get('list.ordering');
		$this->sortDirection = $state->get('list.direction');
		$this->addToolBar();
		if (class_exists("JHtmlSidebar"))
		{
			$this->sidebar = JHtmlSidebar::render();
		}
		parent::display($tpl);
	}
	function getOriginName($origin)
	{
		return ($origin == 0) ? 'Frontend': 'Backend';
	}
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_BFSTOP_HEADING_FAILEDLOGINLIST'), 'bfstop');
		$user = JFactory::getUser();
		if ($user->authorise('core.admin', 'com_bfstop') || $user->authorise('core.options', 'com_bfstop'))
		{
			JToolbarHelper::preferences('com_bfstop');
		}
	}
}
