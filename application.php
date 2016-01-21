<?php

require __DIR__.'/vendor/autoload.php';

use guiassemany\scGenerator\Commands\CreateLookupCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$container = new ContainerBuilder();
$container->register('Filesystem', '\Symfony\Component\Filesystem\Filesystem');
$container->register('Finder', '\Symfony\Component\Finder\Finder');

$Filesystem = $container->get('Filesystem');
$Finder = $container->get('Finder');

$application = new Application();
$application->add(new CreateLookupCommand($Filesystem, $Finder));
$application->run();
