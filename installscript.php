<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla! >= 3
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Installer\InstallerAdapter;

if (JVersion::MAJOR_VERSION < 4)
{
	// Joomla 3.x doesn't autoload JFile and JFolder, according to https://joomla.stackexchange.com/a/10461
	JLoader::register('JFile', JPATH_LIBRARIES . '/joomla/filesystem/file.php');
	JLoader::register('JFolder', JPATH_LIBRARIES . '/joomla/filesystem/folder.php');
	jimport('joomla.filesystem.file');
}

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
		if (JFolder::exists($bfstopPath."views/whitelist"))
		{
			JFolder::delete($bfstopPath."views/whitelist");
			JFolder::delete($bfstopPath."views/whiteip");
			JFile::delete($bfstopPath."models/whitelist.php");
			JFile::delete($bfstopPath."models/whiteip.php");
		}
		return true;
	}
}
