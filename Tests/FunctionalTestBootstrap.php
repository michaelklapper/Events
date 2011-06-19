<?php
namespace F3\FLOW3\Build;


@require_once('vfsStream/vfsStream.php');
if (!class_exists('vfsStreamWrapper')) {
        exit(PHP_EOL . 'FLOW3 Bootstrap Error: The functional test bootstrap requires vfsStream to be installed (e.g. via PEAR). Please also make sure that it is accessible via the PHP include path.' . PHP_EOL . PHP_EOL);
}

$_SERVER['FLOW3_ROOTPATH'] = dirname(__FILE__) . '/../../../../';

require_once($_SERVER['FLOW3_ROOTPATH'] . 'Packages/Framework/FLOW3/Classes/Core/Bootstrap.php');

$bootstrap = new \F3\FLOW3\Core\Bootstrap('Testing');
$bootstrap->run();
