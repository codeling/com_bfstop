<?php
/*
 * Test stub for Joomla\CMS\Language\Text - returns the language key (plus
 * the sprintf arguments) instead of a translation.
**/

namespace Joomla\CMS\Language;

class Text
{
	public static function _($string)
	{
		return $string;
	}

	public static function sprintf($string, ...$args)
	{
		return $string.(count($args) ? ' ['.implode('|', $args).']' : '');
	}
}
