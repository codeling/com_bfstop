<?php

class BFStopLinkHelper
{
	public function getIpInfoLink($ipaddress)
	{
		$menuId = JRequest::getInt('Itemid');
		$link = 'index.php?option=com_bfstop&Itemid='.$menuId.'&view=ipinfo&ipaddress='.$ipaddress;	
		return $link;
	}


}
?>
