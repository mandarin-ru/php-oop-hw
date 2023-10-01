<?php

interface IStorage
{
    public function add(string $key, mixed $data) : void;

    public function remove(string $key) : void;

    public function contains(string $key) : bool;

    public function get(string $key) : mixed;
}

class Storage implements IStorage, JsonSerializable
{
    private $arStorage = [];

    public function add(string $key, mixed $data) : void
    {
        $this->arStorage[$key] = $data;
    }

    public function remove(string $key) : void
    {
        if ($this->contains($key)) {
            unset($this->arStorage[$key]);
        }
    }

    public function contains(string $key) : bool
    {
        return (bool)$this->arStorage[$key];
    }

    public function get(string $key) : mixed
    {
        return $this->arStorage[$key] ?? null;
    }

    public function jsonSerialize()
    {
        return serialize($this);
    }
}

class Animal implements JsonSerializable
{
    public $name;
    public $health;
    public $alive;
    protected $power;

    public function __construct(string $name, int $health, int $power)
    {
        $this->name = $name;
        $this->health = $health;
        $this->power = $power;
        $this->alive = true;
    }

    public function calcDammage()
    {
        return $this->power(mt_rand(100, 300) / 200);
    }

    public function applyDamage(int $damage)
    {
        if ($this->health <= 0) {
            $this->health = 0;
            $this->alive = false;
        }
    }

    public function jsonSerialize()
    {
        return serialize($this);
    }
}

class JSONLogger
{
    protected array $objects = [];

    public function addObject($obj) : void
    {
        $this->objects[] = $obj;
    }

    public function log(string $betweenLogs = ',') : string
    {
        $logs = array_map(function ($obj) {
            return $obj->jsonSerialize();
        }, $this->objects);

        return implode($betweenLogs, $logs);
    }
}

$a1 = new Animal('Murzik', 20, 5);
$a2 = new Animal('Murzik', 20, 5);

$gameStorage = new Storage();
$gameStorage->add('test', mt_rand(1, 10));

$logger = new JSONLogger();
$logger->addObject($a1);
$logger->addObject($a2);
$logger->addObject($gameStorage);

echo $logger->log('<br>') . '<hr>';

/*$a2->applyDamage($a1->calcDammage());*/
$gameStorage->add('other', mt_rand(1, 10));
echo $logger->log('<br>');