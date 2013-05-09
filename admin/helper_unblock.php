<?php

class BFStopUnblockHelper
{
	 public static function checkDBError($db, $logger) {
		$errNum = $db->getErrorNum();
		if ($errNum != 0) {
			$errMsg = $db->getErrorMsg();
			$logger->log("com_bfstop: Database error (#$errNum) occured: $errMsg", JLog::ERROR);
		}
	}

	public static function unblock($db, $id, $source, $logger)
	{
		$db->setQuery('SELECT * FROM #__bfstop_unblock WHERE block_id='.$id);
		$unblockEntry = $db->loadObject();
		self::checkDBError($db, $logger);
		if ($unblockEntry != null) {
			$logger->log("com_bfstop-tokenunblock: Unblock already exists!", JLog::ERROR);
			return false;
		}
		$unblock = new stdClass();
		$unblock->block_id = $id;
		$unblock->source = $source; // source of 1 indicates unblock via email
		$unblock->crdate = date('Y-m-d H:i:s');
		$unblockResult = $db->insertObject('#__bfstop_unblock', $unblock);
		self::checkDBError($db, $logger);
		if (!$unblockResult) {
			$logger->log("com_bfstop-tokenunblock: Inserting unblock failed!", JLog::ERROR);
		}
		return $unblockResult;
	}
}
