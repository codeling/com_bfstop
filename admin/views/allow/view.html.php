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

class BFStopViewAllow extends HtmlView
{
	public function display($tpl = null)
	{
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->addToolbar();
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::base(true).
			'/components/com_bfstop/views/block/tmpl/edit.css');
		JFactory::getApplication()->enqueueMessage(Text::sprintf('COM_BFSTOP_YOUR_IP_IS', getIPAddr(getLogger())), 'message');
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);
		$isNew = ($this->item->id == 0);
		JToolBarHelper::title($isNew
			? Text::_('COM_BFSTOP_BLOCK_NEW')
			: Text::_('COM_BFSTOP_BLOCK_EDIT'));
		JToolBarHelper::save('allow.save');
		JToolBarHelper::cancel('allow.cancel', $isNew
			? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}
}
