<?php
define('VERSION','1.0.0');
define('PAGE_TO_ROOT','');
error_reporting(E_ERROR | E_PARSE);

if (!defined('INSTALL_PATH')) {
    define('INSTALL_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');
}
if (!defined('CONFIG_PATH')) {
    define('CONFIG_PATH', INSTALL_PATH . 'core/config');
}
if (!defined('PUBLIC_PATH')) {
    define('INSTALL_PATH', INSTALL_PATH . 'public');
}
# Save config.
$config = array();

# Save menu.
$menuBlocks = array();

# Load config file.
include_once INSTALL_PATH.'/core/config/config.php';

#Load function set all local link.
include_once INSTALL_PATH.'/core/config/symlinks.php';

#Load database connect and function.
include_once INSTALL_PATH.'/core/include/db_functions.php';

#Load funtion about draw page.
include_once INSTALL_PATH.'/core/include/draw_page.php';

#Load root-me function.
include_once INSTALL_PATH.'/core/main/root-me.php';

#Load high right function
include_once CONFIG_PATH.'/high_right.php';

