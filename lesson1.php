<?php

class Tag
{
    protected string $name;
    protected array $arAttributes;
    protected array $arChild;

    public function attr($key, $value)
    {
        $this->arAttributes[$key] = $value;
    }

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class SingleTag extends Tag
{
    public function render()
    {
        return "<" . $this->name . ">";
    }
}

class PairTag extends Tag
{
    public function appendChild(Tag $item)
    {
        $this->arChild[] = $item;
    }

    public function render()
    {
        foreach ($this->arChild as $item) {
            $content .= $item->render();
        }
        return "<" . $this->name . "> " . $content . "  </" . $this->name . ">";
    }
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