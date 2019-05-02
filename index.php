
<?php
/**
 * Front to the Ziki app. This file doesn't do anything, but bootstraps
 * Ziki to load start.
 *
 * @package Ziki
 */
define('ZIKI', true);
define('ZIKI_BASE_PATH', __DIR__);
define('SITE_URL', 'http://localhost:8000/');
define('SITE_AUTH', 'kamponistullar@gmail.com');

$ziki = require_once ZIKI_BASE_PATH . '/src/bootstrap.php';

$ziki->start();
