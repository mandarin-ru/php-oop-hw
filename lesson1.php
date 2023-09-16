<?php

class Tag
{
}

class SingleTag extends Tag
{
}

class PairTag extends Tag
{
}

$img = new SingleTag('img');

$img->attr('src', './nz');
$img->attr('alt', 'nz');

$hr = new SingleTag('hr');

$a = new PairTag('a');
$a->attr('href', './nz');
$a->appendChild($img);
$a->appendChild($hr);

echo $a->render();