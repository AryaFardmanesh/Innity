<?php

include_once __DIR__ . "/model.php";

define('HOTEL_STATUS_OK', 10);
define('HOTEL_STATUS_REMOVED', 20);

class HotelModel extends Model {
	public function __construct(
		public string $owner,
		public string $image,
		public string $name,
		public string $description,
		public string $country,
		public string $city,
		public int $stars = 0,
		public int $status = HOTEL_STATUS_OK,
	) {
		parent::__construct();
		$this->validate();
	}

	public function validate(): bool {
		if (!TestModel::checkLen($this->owner, 32, 32)) {
			$this->setError("The owner must be between 32 and 32 characters long.");
			return false;
		}
		if (!TestModel::checkLen($this->image, 1, 128)) {
			$this->setError("The image must be between 1 and 128 characters long.");
			return false;
		}
		if (!TestModel::checkLen($this->name, 1, 128)) {
			$this->setError("The name must be between 1 and 128 characters long.");
			return false;
		}
		if (!TestModel::checkLen($this->description, 0, 512)) {
			$this->setError("The description must be between 0 and 512 characters long.");
			return false;
		}
		if (!TestModel::checkLen($this->country, 1, 64)) {
			$this->setError("The country must be between 1 and 64 characters long.");
			return false;
		}
		if (!TestModel::checkLen($this->city, 1, 64)) {
			$this->setError("The city must be between 1 and 64 characters long.");
			return false;
		}
		if ($this->stars === null || $this->stars > 6 || $this->stars < 0) {
			$this->setError("Invalid stars.");
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
