<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

class bfstopModeltokenunblock extends JModel {

	public function unblock($token) {
		$this->_db->setQuery('SELECT * FROM #__bfstop_unblock_token WHERE token='.
			$this->_db->quote($token));
		$token = $this->_db->loadObject();
		if ($token == null)
		{
			return false;
		}
		$unblock = new stdClass();
		$unblock->block_id = $token->block_id;
		$unblock->source = 1; // source of 1 indicates unblock via email
		$unblock->crdate = date('Y-m-d H:i:s');
		if (!$this->_db->insertObject('#__bfstop_unblock', $unblock))
		{
			return false;
		}
		return ($this->_db->execute('DELETE FROM #__bfstop_unblock_token WHERE token='.
				$this->_db->quote($token))
			!= false);
	}
}
