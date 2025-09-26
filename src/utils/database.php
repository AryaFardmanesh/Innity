<?php

include_once __DIR__ . "/../config.php";

class Database {
	public string|null $error = null;

	public mysqli|null $connection = null;

	public function connect(): bool {
		$this->connection = mysqli_connect(
			DB_HOSTNAME,
			DB_USERNAME,
			DB_PASSWORD,
			DB_NAME,
		);

		if ($this->connection == null)
			return false;
		return true;
	}

	public function disconnect(): bool {
		if (!$this->isConnect()) {
			return true;
		}

		mysqli_close($this->connection);
		$this->connection = null;
		return true;
	}

	public function isConnect(): bool {
		return $this->connection != null;
	}

	public function execute(string $query): mysqli_result|bool {
		if (!$this->isConnect()) {
			$this->error = "Database is not connected for execute the query.";
			return false;
		}

		return mysqli_query($this->connection, $query);
	}
}

?>
