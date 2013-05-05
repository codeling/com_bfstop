<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

class bfstopModeltokenunblock extends JModel {

        public function checkDBError() {
                $errNum = $this->_db->getErrorNum();
                if ($errNum != 0) {
                        $errMsg = $this->_db->getErrorMsg();
                        echo "Database error (#$errNum) occured: $errMsg";
                }
        }

	public function unblock($token) {
		$this->_db->setQuery('SELECT * FROM #__bfstop_unblock_token WHERE token='.
			$this->_db->quote($token));
		$unblockTokenEntry = $this->_db->loadObject();
		$this->checkDBError();
		if ($unblockTokenEntry == null) {
			echo("Token not found<br/>");
			return false;
		}
		$this->_db->setQuery('SELECT * FROM #__bfstop_unblock WHERE id='.
			$unblockTokenEntry->block_id);
		$unblockEntry = $this->_db->loadObject();
		$this->_db->checkDBError();
		if ($unblockEntry != null) {
			echo("Unblock already exists!<br/>");
			return false;
		}
		$unblock = new stdClass();
		$unblock->block_id = $unblockTokenEntry->block_id;
		$unblock->source = 1; // source of 1 indicates unblock via email
		$unblock->crdate = date('Y-m-d H:i:s');
		$unblockResult = $this->_db->insertObject('#__bfstop_unblock', $unblock);
		$this->checkDBError();
		if (!$unblockResult) {
			echo("Inserting unblock failed!<br/>");
			return false;
		}
		$sql = 'DELETE FROM #__bfstop_unblock_token WHERE token='.
				$this->_db->quote($token);
		$this->_db->setQuery($sql);
		$success = $this->_db->execute();
		$this->checkDBError();
		if (!$success) {
			echo("Could not delete unblock_token...<br/>");
		}
		return $success;
	}
}
