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
use Joomla\CMS\MVC\Controller\BaseController;

if (!Factory::getUser()->authorise('core.manage', 'com_bfstop'))
{
	throw new JAccessExceptionNotallowed(Text::_('JERROR_ALERTNOAUTHOR'), 403);
}
JLoader::register('BFStopHelper', dirname(__FILE__).'/helpers/bfstop.php');

require_once(JPATH_ADMINISTRATOR.'/components/com_bfstop/helpers/log.php');

$controller = BaseController::getInstance('bfstop');
$jinput = Factory::getApplication()->input;
$task = $jinput->get('task', "", 'STR');
$controller->execute($task);
$controller->redirect();
