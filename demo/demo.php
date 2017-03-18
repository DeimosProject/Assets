<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$assets = new \Deimos\Assets\Assets(__DIR__);

$assets->get('js')
    ->push('/node_modules/jquery/dist/jquery.min.js')
    ->setProperty('defer')
    ->setProperty('async');

$assets->get('css')
    ->push('/node_modules/bootstrap/dist/bootstrap.min.css');

$assets->get('js')
    ->shift(basename(__FILE__))
    ->setProperty('type', 'text/javascript');

foreach (scandir(dirname(__DIR__) . '/src/Assets') as $file)
{
    if ($file{0} === '.')
    {
        continue;
    }

    $assets->get('js')->push($file);
}

foreach ($assets as $asset)
{
    echo (string)$asset, PHP_EOL;
}