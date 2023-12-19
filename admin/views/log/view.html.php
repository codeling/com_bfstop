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

require_once(JPATH_ADMINISTRATOR.'/components/com_bfstop/helpers/links.php');

class BFStopViewLog extends HtmlView
{
	function display($tpl = null) {
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$state            = $this->get('State');
		$this->sortColumn = $state->get('list.ordering');
		$this->sortDirection = $state->get('list.direction');
		$this->addToolBar();
		if (class_exists("JHtmlSidebar") && JVersion::MAJOR_VERSION < 4)
		{
			$this->sidebar = JHtmlSidebar::render();
		}
		parent::display($tpl);
	}

	protected function addToolBar()
	{
		JToolBarHelper::title(Text::_('COM_BFSTOP_HEADING_LOGS'), 'bfstop');
		JToolBarHelper::divider();
		$user = JFactory::getUser();
		if ($user->authorise('core.admin', 'com_bfstop') || $user->authorise('core.options', 'com_bfstop'))
		{
			JToolbarHelper::preferences('com_bfstop');
		}
	}
}
