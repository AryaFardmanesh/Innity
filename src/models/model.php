<?php

include_once __DIR__ . "/../utils/id.php";

abstract class Model {
	private string|null $error = null;

	protected function setError(string $msg): void {
		$this->error = $msg;
	}

	public function getError(): string|null {
		$err = $this->error;
		$this->error = null;
		return $err;
	}

	public abstract function validate(): bool;

	public string $id;

	public DateTimeImmutable|null $create_at = null;

	public function __construct() {
		$this->id = generateID();
	}
}

class TestModel {
	public static function checkLen(string|null $data, int $min, int $max, bool $nullable = false): bool {
		if ($nullable && $data === null) {
			return true;
		}
		if ($data === null) {
			return false;
		}

		$len = strlen($data);

		if ($len > $max || $len < $min) {
			return false;
		}

		return true;
	}
}

?>
