<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class BfstopModelBlock extends JModelAdmin
{
	public function getTable($type = 'Block', $prefix = 'BfstopTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_bfstop.block', 'block',
			array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_bfstop.edit.block.data', array());
		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}
}
