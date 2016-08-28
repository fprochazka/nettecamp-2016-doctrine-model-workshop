<?php

declare(strict_types = 1);

require_once __DIR__ . '/../vendor/autoload.php';

// configure environment
Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

// create temporary directory
define('TEMP_DIR', __DIR__ . '/../temp/tests/' . (isset($_SERVER['argv']) ? md5(serialize($_SERVER['argv'])) : getmypid()));
@mkdir(TEMP_DIR, 0777, true);
Tester\Helpers::purge(TEMP_DIR);
