<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

class bfstopModeltokenunblock extends JModel {

        public function checkDBError($logger) {
                $errNum = $this->_db->getErrorNum();
                if ($errNum != 0) {
                        $errMsg = $this->_db->getErrorMsg();
                        $logger->log("com_bfstop-tokenunblock: Database error (#$errNum) occured: $errMsg", JLog::ERROR);
                }
        }

	public function unblock($token, $logger) {
		$this->_db->setQuery('SELECT * FROM #__bfstop_unblock_token WHERE token='.
			$this->_db->quote($token));
		$unblockTokenEntry = $this->_db->loadObject();
		$this->checkDBError($logger);
		if ($unblockTokenEntry == null) {
			$logger->log("com_bfstop-tokenunblock: Token not found.", JLog::ERROR);
			return false;
		}
		$this->_db->setQuery('SELECT * FROM #__bfstop_unblock WHERE id='.
			$unblockTokenEntry->block_id);
		$unblockEntry = $this->_db->loadObject();
		$this->_db->checkDBError($logger);
		if ($unblockEntry != null) {
			$logger->log("com_bfstop-tokenunblock: Unblock already exists!", JLog::ERROR);
			return false;
		}
		$unblock = new stdClass();
		$unblock->block_id = $unblockTokenEntry->block_id;
		$unblock->source = 1; // source of 1 indicates unblock via email
		$unblock->crdate = date('Y-m-d H:i:s');
		$unblockResult = $this->_db->insertObject('#__bfstop_unblock', $unblock);
		$this->checkDBError($logger);
		if (!$unblockResult) {
			$logger->log("com_bfstop-tokenunblock: Inserting unblock failed!", JLog::ERROR);
			return false;
		}
		$sql = 'DELETE FROM #__bfstop_unblock_token WHERE token='.
				$this->_db->quote($token);
		$this->_db->setQuery($sql);
		$success = $this->_db->execute();
		$this->checkDBError($logger);
		if (!$success) {
			$logger->log("com_bfstop-tokenunblock: Could not delete unblock_token.", JLog::ERROR);
		}
		return $success;
	}
}
