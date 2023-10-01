Реализуйте Storage имплементирующий IStorage.

Interface IStorage{
	public function add(string $key, mixed $data) : void;
	public function remove(string $key) : void;
	public function contains(string $key) : bool;
	public function get(string $key) : mixed;
}

Обяжите Animal и Storage реализовать метод jsonSerialize, который нужен классу JSONLogger:

class JSONLogger{
	protected array $objects = [];

	public function addObject($obj) : void{
		$this->objects[] = $obj;
	}

	public function log(string $betweenLogs = ',') : string{
		$logs = array_map(function($obj){
			return $obj->jsonSerialize();
		}, $this->objects);

		return implode($betweenLogs, $logs);
	}
}

Подробное описание идей в видео php-oop-hw2.