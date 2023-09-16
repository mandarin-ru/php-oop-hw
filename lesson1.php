<?php

class Tag
{
    protected string $name;
    protected array $arAttributes;
    protected array $arChild;

    public function attr($key, $value) : self
    {
        $this->arAttributes[$key] = $value;
        return $this;
    }

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getAttr() : array
    {
        return $this->arAttributes ?? [];
    }

    public function strAttribute() : string
    {
        $str = '';
        foreach ($this->getAttr() as $key => $attribute) {
            $str .= $key . '="' . $attribute . '" ';
        }
        return $str;
    }
}

class SingleTag extends Tag
{
    public function render()
    {
        return "<" . $this->name . "  " . $this->strAttribute() . " >";
    }
}

class PairTag extends Tag
{
    public function appendChild(Tag $item) : self
    {
        $this->arChild[] = $item;
        return $this;
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

$img->attr('src', './nz')->attr('alt', 'nz');

$hr = new SingleTag('hr');

$a2 = (new PairTag('a'))->attr('href', './nz')->appendChild($img)->appendChild($hr);

echo (new PairTag('a'))->attr('href', './nz')->appendChild($a2)->appendChild($img)->appendChild($hr)->render();