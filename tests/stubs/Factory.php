<?php
/*
 * Test stub for Joomla\CMS\Factory - getApplication() returns a spy which
 * records enqueued messages. getDbo() deliberately fails, so that a test
 * accidentally hitting the database is noticed immediately.
**/

namespace Joomla\CMS;

class ApplicationSpy
{
	public array $messages = array();

	public function enqueueMessage($msg, $type = 'message')
	{
		$this->messages[] = array('message' => $msg, 'type' => $type);
	}
}

class Factory
{
	private static ?ApplicationSpy $application = null;

	public static function getApplication()
	{
		if (self::$application === null)
		{
			self::$application = new ApplicationSpy();
		}
		return self::$application;
	}

	public static function getDbo()
	{
		throw new \LogicException('Factory::getDbo() is not available in unit tests - mock the DatabaseHelper instead');
	}

	public static function reset()
	{
		self::$application = null;
	}
}
