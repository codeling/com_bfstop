<?php defined('_JEXEC') or die('Direct Access to this script is not allowed.');

jimport('joomla.application.component.view');
jimport('joomla.utilities.date');


class bfstopViewtokenunblock extends JView {

	function display($tpl = null) {
		$this->model = $this->getModel();
	}
}

