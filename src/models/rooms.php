<?php

include_once __DIR__ . "/model.php";

define('ROOMS_STATUS_OK', 10);
define('ROOMS_STATUS_REMOVED', 20);

class RoomModel extends Model {
	public function __construct(
		public string $hotel,
		public string|null $reserved_by = null,
		public DateTimeImmutable|null $reserved_time = null,
		public int|null $reserved_for = null,
		public string $image,
		public string $description,
		public int $price = 1,
		public int $number,
		public int $bed = 1,
		public int $capacity = 1,
		public int $status = ROOMS_STATUS_OK,
	) {
		parent::__construct();
		$this->validate();
	}

	public function validate(): bool {
		if (!TestModel::checkLen($this->hotel, 32, 32)) {
			$this->setError("The hotel id must be between 32 and 32 characters long.");
			return false;
		}
		if (!TestModel::checkLen($this->reserved_by, 32, 32, true)) {
			$this->setError("The reserved_by must be between 32 and 32 characters long.");
			return false;
		}
		if ($this->reserved_time !== null && !$this->reserved_time instanceof DateTimeImmutable) {
			$this->setError("The reserved_time must be date time.");
			return false;
		}
		if ($this->reserved_for !== null && $this->reserved_for < 1) {
			$this->setError("The reserved_for is invalid.");
			return false;
		}
		if (!TestModel::checkLen($this->image, 1, 128)) {
			$this->setError("The image must be between 1 and 128 characters long.");
			return false;
		}
		if (!TestModel::checkLen($this->description, 0, 512)) {
			$this->setError("The description must be between 0 and 512 characters long.");
			return false;
		}
		if ($this->price < 0) {
			$this->setError("The price is invalid.");
			return false;
		}
		if ($this->number < 0) {
			$this->setError("The number is invalid.");
			return false;
		}
		if ($this->bed < 0) {
			$this->setError("The bed is invalid.");
			return false;
		}
		if ($this->capacity < 0) {
			$this->setError("The bed is invalid.");
			return false;
		}
		if ($this->status === null) {
			$this->setError("status cannot be empty.");
			return false;
		}

		return true;
	}
}

?>
