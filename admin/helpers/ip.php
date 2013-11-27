<?php

 
function get_whois($ip)
{
require_once(JPATH_ADMINISTRATOR
                .DIRECTORY_SEPARATOR.'components'
                .DIRECTORY_SEPARATOR.'com_bfstop'
                .DIRECTORY_SEPARATOR.'helpers'
                .DIRECTORY_SEPARATOR.'phpwhois'
                .DIRECTORY_SEPARATOR.'whois.main.php');
require_once(JPATH_ADMINISTRATOR
                .DIRECTORY_SEPARATOR.'components'
                .DIRECTORY_SEPARATOR.'com_bfstop'
                .DIRECTORY_SEPARATOR.'helpers'
                .DIRECTORY_SEPARATOR.'phpwhois'
                .DIRECTORY_SEPARATOR.'whois.utils.php');
	$whois = new Whois();
	$whois->non_icann = true;
	$result = $whois->Lookup($ip);
	$winfo = '';
	if (!empty($result['rawdata']))
	{
		$utils = new utils;
		return $utils->showHTML($result);
	}
	else
	{
		if (isset($whois->Query['errstr']))
			$winfo = implode($whois->Query['errstr'],"\n<br></br>");
		else
			$winfo = 'Unexpected error';
	}
	return $winfo;
}
