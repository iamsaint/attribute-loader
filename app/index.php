<?php

require __DIR__ . '/../vendor/autoload.php';

use Loader\Loader;
use App\Form;
use App\Entity;

$source = new Form();
$source->setTitle('product');
$source->setPrice(100);

$target = new Entity();

(new Loader)
    ->source($source)
    ->target($target)
    ->load();

var_dump($target->getTitle());
var_dump($target->getPrice());