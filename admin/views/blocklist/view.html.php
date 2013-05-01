<?php
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class EventCalendarViewEventCalendar extends JView
{
    function display($tpl = null) 
    {
        if (count($errors = $this->get('Errors'))) 
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        $this->addToolBar();
        parent::display($tpl);
        $this->setDocument();
    }

    protected function addToolBar() 
    {
        $state    = $this->get('State');
        JToolBarHelper::title(JText::_('COM_BFSTOP_ADMIN'), 'bfstp');
        JToolBarHelper::divider();
        JToolBarHelper::preferences('com_bfstop');
    }

    protected function setDocument() 
    {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_BFSTOP_ADMIN'));
    }
}
