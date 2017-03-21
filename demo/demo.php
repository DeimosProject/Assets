<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$assets = new \Deimos\Assets\Assets(__DIR__);

$assets->get('js')
    ->push('/node_modules/jquery/dist/jquery.min.js', 'jquery')
    ->setProperty('defer')
    ->setProperty('async')
//    ->before(['bootstrap', 'demo'])

;

$assets->get('js')
    ->shift('/node_modules/bootstrap/dist/bootstrap1.min.js', 'bootstrap1')

;

$assets->get('js')
    ->push('/node_modules/bootstrap/dist/bootstrap2.min.js', 'bootstrap2')

;

$assets->get('js')
    ->push('/node_modules/bootstrap/dist/bootstrap3.min.js', 'bootstrap3')
    ->after(['jquery', 'bootstrap4'])
    ->before(['bootstrap1'])

;

$assets->get('js')
    ->push('/node_modules/bootstrap/dist/bootstrap4.min.js', 'bootstrap4')

;

$assets->get('js')
    ->push('/node_modules/bootstrap/dist/bootstrap.min.js', 'bootstrap')

;

$assets->get('css')
    ->push('/node_modules/bootstrap/dist/bootstrap.min.css', 'bootstrap');

$assets->get('js')
    ->shift('/'.basename(__FILE__), 'demo')
    ->setProperty('type', 'text/javascript')
    ->before(['bootstrap'])

;

//foreach (scandir(dirname(__DIR__) . '/src/Assets') as $file)
//{
//    if ($file{0} === '.')
//    {
//        continue;
//    }
//
//    $assets->get('js')->push($file);
//}

foreach ($assets as $asset)
{
    echo (string)$asset, PHP_EOL;
}