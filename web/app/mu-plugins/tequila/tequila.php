<?php

/**
 * Plugin Name: Tequila
 * Description: Helpers and common behaviour to themes
 * Version: 1.0.0
 * Author: TequilaRapido
 */


require_once __DIR__ . '/helpers/acf.php';
require_once __DIR__ . '/helpers/assets.php';
require_once __DIR__ . '/helpers/menu.php';
require_once __DIR__ . '/helpers/wpml.php';

require_once __DIR__ . '/hooks/admin.php';
//require_once __DIR__ . '/hooks/multisite.php';
require_once __DIR__ . '/hooks/support.php';
require_once __DIR__ . '/hooks/wp-rocket.php';
require_once __DIR__ . '/hooks/wpml.php';
