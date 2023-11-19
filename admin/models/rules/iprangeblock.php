<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

require_once(JPATH_ADMINISTRATOR.'/components/com_bfstop/helpers/ipvalidate.php');

class JFormRuleIprangeblock extends JFormRule
{
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
		return (validIPRange($value) && !matchesCurrentIP($value));
	}
}
