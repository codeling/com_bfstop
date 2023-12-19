<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class BFStopControllerBlockList extends AdminController
{
	public function getModel($name = 'blocklist', $prefix = 'bfstopmodel', $config = [])
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	function unblock()
	{
		$logger = getLogger();
		$input =  JFactory::getApplication()->input;
		$ids = $input->post->get('cid', array(), 'array');
		$model = $this->getModel('blocklist');
		$message = $model->unblock($ids, $logger);
		// redirect to blocklist view
		$this->setRedirect(JRoute::_('index.php?option=com_bfstop&view=blocklist',false),
			$message, 'notice');
	}
}
