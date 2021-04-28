<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2021 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;
jimport('joomla.application.component.view');

class BFStopViewBlock extends JViewLegacy
{
	public function display($tpl = null)
	{
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->addToolbar();
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::base(true).
			'/components/com_bfstop/views/block/tmpl/edit.css');
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);
		$isNew = ($this->item->id == 0);
		JToolBarHelper::title($isNew
			? JText::_('COM_BFSTOP_BLOCK_NEW')
			: JText::_('COM_BFSTOP_BLOCK_EDIT'));
		JToolBarHelper::save('block.save');
		JToolBarHelper::cancel('block.cancel', $isNew
			? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}
}
