<?php

class BFStopUnblockHelper
{
	public static function unblock($db, $ids, $source, $logger) {
		if (!is_array($ids) || sizeof($ids) == 0)
		{
			$logger->log("com_bfstop unblock: Invalid parameter IDs given!", JLog::ERROR);
			return false;
		}
		$sql = 'SELECT * FROM #__bfstop_unblock WHERE '.
			'block_id IN ('.implode($ids, ", ").')';
		$db->setQuery($sql);
		$unblockEntry = $db->loadObject();
		BFStopDBHelper::checkDBError($db, $logger);
		if ($unblockEntry != null) {
			$logger->log("com_bfstop unblock: Unblock already exists!", JLog::ERROR);
			return false;
		}
		$unblockResult = true;
		$unblockDate = date('Y-m-d H:i:s');
		foreach($ids as $id) {
			$unblock = new stdClass();
			$unblock->block_id = $id;
			$unblock->source = $source; // source of 1 indicates unblock via email
			$unblock->crdate = $unblockDate;
			$unblockResult = $db->insertObject('#__bfstop_unblock', $unblock);
			BFStopDBHelper::checkDBError($db, $logger);
			if (!$unblockResult) {
				$logger->log("com_bfstop-tokenunblock: Inserting unblock failed!", JLog::ERROR);
			}
		}
		return $unblockResult;
	}
}
