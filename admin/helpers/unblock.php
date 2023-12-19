<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

use Joomla\CMS\Log\Log;

require_once(JPATH_ADMINISTRATOR.'/components/com_bfstop/helpers/params.php');

class BFStopUnblockHelper
{
	public static function unblock($db, $ids, $source, $logger) {
		if (!is_array($ids) || sizeof($ids) == 0)
		{
			$logger->log("com_bfstop unblock: Invalid parameter IDs given!", Log::ERROR);
			return false;
		}
		
		$unblockResult = true;
		$unblockDate = date('Y-m-d H:i:s');
		foreach($ids as $id) {
			if (filter_var($id, FILTER_VALIDATE_IP))
			{
				$htaccessPath = BFStopParamHelper::get('htaccessPath', 'params', JPATH_ROOT);
				$htaccessPath = $htaccessPath === "" ? JPATH_ROOT : $htaccessPath;
				$htaccess = new BFStopHtAccess($htaccessPath, null);
				$result = $htaccess->undenyIP($id);
				$logger->log("com_bfstop unblock: .htaccess unblock ".(($result)?"successful":"not successful")."!", Log::ERROR);

			} else {
				try {
					$id = (int)$id;
					$sql = 'SELECT * FROM #__bfstop_unblock WHERE block_id='.$id;
					$db->setQuery($sql);
					$unblockEntry = $db->loadObject();
					if ($unblockEntry != null) {
						$logger->log("com_bfstop unblock: Unblock already exists!", Log::ERROR);
						return false;
					}
					$unblock = new stdClass();
					$unblock->block_id = $id;
					$unblock->source = $source; // source of 1 indicates unblock via email
					$unblock->crdate = $unblockDate;
					$unblockResult = $db->insertObject('#__bfstop_unblock', $unblock);
				} catch (RuntimeException $e) {
					$logger->log($e->getMessage(), Log::ERROR);
				}
				if (!$unblockResult) {
					$logger->log("com_bfstop-tokenunblock: Inserting unblock failed!", Log::ERROR);
				}
			}
		}
		return $unblockResult;
	}
}
