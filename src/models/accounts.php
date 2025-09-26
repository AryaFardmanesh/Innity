<?php

include_once __DIR__ . "/model.php";

define('ACCOUNT_ROLE_NORMAL', 10);
define('ACCOUNT_ROLE_MANAGER', 20);
define('ACCOUNT_ROLE_ADMIN', 30);

define('ACCOUNT_STATUS_OK', 10);
define('ACCOUNT_STATUS_REMOVED', 20);

class AccountModel extends Model {
	public function __construct(
		public string $username,
		public string $password,
		public int $role = ACCOUNT_ROLE_NORMAL,
		public int $status = ACCOUNT_STATUS_OK,
	) {
		parent::__construct();
		$this->validate();
	}

	public function validate(): bool {
		if (!TestModel::checkLen($this->username, 4, 64)) {
			$this->setError("The username must be between 4 and 64 characters long.");
			return false;
		}
		if (!TestModel::checkLen($this->password, 4, 64)) {
			$this->setError("The password must be between 4 and 64 characters long.");
			return false;
		}
		if ($this->role === null) {
			$this->setError("role cannot be empty.");
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
