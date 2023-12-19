<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class BfstopViewSettings extends HtmlView
{
	public function display($tpl = null)
	{
		$this->addToolbar();
		if (class_exists("JHtmlSidebar") && JVersion::MAJOR_VERSION < 4)
		{
			$this->sidebar = JHtmlSidebar::render();
		}
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		ToolbarHelper::title(Text::_('COM_BFSTOP_HEADING_SETTINGS'));
		ToolbarHelper::custom('settings.testNotify', 'preview', '',
			'TEST_NOTIFICATION', false, false);
		$user = Factory::getUser();
		if ($user->authorise('core.admin', 'com_bfstop') || $user->authorise('core.options', 'com_bfstop'))
		{
			ToolbarHelper::preferences('com_bfstop');
		}
	}
}
