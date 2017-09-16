<?php
/*
 * @package Brute Force Stop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2014 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class bfstopModellog extends JModelList
{
	protected $cachedLogLines;

	public function __construct($config = array())
	{
		$config['filter_fields'] = array(
			'logline'
		);
		$cachedLogLines = null;
		parent::__construct($config);
	}

	private function getLogLines()
	{
		if (is_null($this->cachedLogLines))
		{
			$application = JFactory::getApplication();
			$log_path = $application->getCfg('log_path');
			$logfile = fopen($log_path."/plg_system_bfstop.log.php", 'r');
			if (!$logfile)
			{
			    return;
			}
			$this->cachedLogLines = array();
			$count = 0;
			while (($line = fgets($logfile)) !== false)
			{
				if ($count > 5)
				{
					$logItems = explode(" ", $line);
					if (count($logItems) < 3)
					{
						$application->enqueueMessage("Invalid log line: ".$line, 'error');
					}
					else
					{
						$logLineObj = new stdClass();
						$logLineObj->date = $logItems[0];
						$logLineObj->priority = $logItems[1];
						$logLineObj->message = implode(" ", array_slice($logItems, 2, count($logItems)-2));
						$this->cachedLogLines[] = $logLineObj;
					}
				}
				$count++;
			}
			fclose($logfile);
		}
		return $this->cachedLogLines;
	}

	private function getPaginatedLogLines($start, $count)
	{
		$direction = $this->getState('list.direction');
		$items = $this->getLogLines();
		if (strtolower($direction) === 'asc')
		{
			sort($items);
		}
		else
		{
			rsort($items);
		}
		$current = 0;
		$result = array();
		foreach($items as $entry)
		{
			if ($current >= $start)
			{
				if (($current - $start) >= $count)
				{
					break;
				}
				$result[] = $entry;
			}
			$current++;
		}
		return $result;
	}

	public function getItems()
	{
		$start = $this->getStart();
		$count = $this->getState('list.limit');
		$result = $this->getPaginatedLogLines($start, $count);
		return $result;
	}

	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState('logline', 'ASC');
	}

	public function getTotal()
	{
		return count($this->getLogLines());
	}
}
