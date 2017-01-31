<?php
/*
 * @package Brute Force Stop Component (com_bfstop) for Joomla! >=2.5
 * @author Bernhard Froehler
 * @copyright (C) 2012-2014 Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class BfstopViewIpinfo extends JViewLegacy
{
	public function display($tpl = null)
	{
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		$input = JFactory::getApplication()->input;
		$this->ipAddress = $input->getString("ipaddress");

		// freegeoip.net is a free and open source service, 10,000 requests allowed
		$error = false;
		set_error_handler(function() {
			$error = true;
		});
		$details = json_decode(file_get_contents("https://freegeoip.net/json/".$this->ipAddress));
		restore_error_handler();
		// TODO: provide alternatives, e.g.
		// - different service, e.g.:
		//        or http://ipinfo.io/ipAddress/json (might cost money if you do more requests)
		//        through $details = json_decode(file_get_contents("url"));
		// - local file
		//     e.g. http://lite.ip2location.com/

		if ($error || is_null($details))
		{
			$this->ipInfo = JText::_("COM_BFSTOP_NO_IPINFO_AVAILABLE");
		}
		else
		{
			$this->ipInfo = "<pre>".JText::sprintf("COM_BFSTOP_IPINFO_DETAILS",
				$details->country_code,
				$details->country_name,
				$details->region_name,
				$details->city,
				$details->zip_code,
				$details->latitude,
				$details->longitude)."</pre>";
		}
		$this->addToolbar();
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		JToolBarHelper::title(JText::sprintf('COM_BFSTOP_HEADING_IPINFO', $this->ipAddress), 'bfstop');
		JToolBarHelper::divider();
		JToolBarHelper::back();
	}
}
