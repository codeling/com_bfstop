<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >= 3
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

use Joomla\Filesystem\Folder;
use Joomla\CMS\Installer\InstallerAdapter;

class com_bfstopInstallerScript
{
	/**
	 * @param   InstallerAdapter  $adapter  The object responsible for running this script
	 */
	public function __construct(InstallerAdapter $adapter)
	{
	}
	public function update(InstallerAdapter $adapter)
	{
		$bfstopPath = JPATH_ADMINISTRATOR."/components/com_bfstop/";
		$oldFolders = array( "views/whitelist", "views/whiteip" );
		$oldFiles = array( "models/whitelist.php", "models/whiteip.php" );
		foreach ($oldFolders as $folder)
		{
			if (file_exists($bfstopPath.$folder) && is_dir($bfstopPath.$folder))
			{
				Folder::delete($bfstopPath.$folder);
			}
		}
		foreach ($oldFiles as $file)
		{
			if (file_exists($bfstopPath.$file))
			{
				unlink($bfstopPath.$file);
			}
		}
		return true;
	}
}
