<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

namespace Codeling\Component\Bfstop\Administrator\View\Settings;

defined('_JEXEC') or die;

use Codeling\Component\Bfstop\Administrator\Helper\ToolbarHelper as BfstopToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
	public function display($tpl = null)
	{
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		ToolbarHelper::title(Text::_('COM_BFSTOP_HEADING_SETTINGS'));
		ToolbarHelper::custom('settings.testNotify', 'preview', '',
			'TEST_NOTIFICATION', false, false);
		BfstopToolbarHelper::addOptions();
	}
}
