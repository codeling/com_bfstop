<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');

class BfstopViewSettings extends JViewLegacy
{
	public function display($tpl = null)
	{
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		$this->addToolbar();
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('COM_BFSTOP_SUBMENU_SETTINGS'));
		JToolBarHelper::custom('settings.testNotify', 'preview', '',
			'TEST_NOTIFICATION', false, false);
	}
}
