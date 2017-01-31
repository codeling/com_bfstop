<?php
/*
 * @package Brute Force Stop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2014 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class BfstopModelHtblock extends JModelAdmin
{
	public function getItem($pk = NULL)
	{
		return array('ipaddress' => '0.0.0.0');
	}
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_bfstop.htblock', 'htblock',
			array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_bfstop.edit.htblock.data', array());
		return $data;
	}
}
