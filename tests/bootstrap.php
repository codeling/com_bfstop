<?php
/*
 * @package BFStop Component (com_bfstop) for Joomla!
 * @author Bernhard Froehler
 * @copyright (C) Bernhard Froehler
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

// every source file starts with "defined('_JEXEC') or die;"
define('_JEXEC', 1);

require_once dirname(__DIR__).'/vendor/autoload.php';

// Minimal stand-ins for the Joomla CMS classes used by the code under test;
// the integration tests (in the bfstop plugin repository) run against a
// real Joomla site instead.
require_once __DIR__.'/stubs/Factory.php';
require_once __DIR__.'/stubs/Text.php';
