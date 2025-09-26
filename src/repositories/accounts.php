<?php

include_once __DIR__ . "/repository.php";
include_once __DIR__ . "/../config.php";
include_once __DIR__ . "/../models/accounts.php";
include_once __DIR__ . "/../utils/database.php";

class AccountRepository extends Repository {
	public static function create(string $username, string $password, int $role = ACCOUNT_ROLE_NORMAL): AccountModel|null {
		$account = new AccountModel($username, $password, $role);
		$modelErr = $account->getError();
		if ($modelErr !== null) {
			parent::setError($modelErr);
			return null;
		}
		unset($modelErr);

		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$id = $account->id;
		$username = $account->username;
		$password = $account->password;
		$role = $account->role;
		$status = $account->status;
		$create_at = $account->create_at;

		if ($create_at === null) {
			$create_at = "CURRENT_TIMESTAMP";
		}

		$result = $db->execute(
			"SELECT * FROM `accounts`
			WHERE `accounts`.`username` = '$username';"
		);

		if (mysqli_num_rows($result) !== 0) {
			$db->disconnect();
			parent::setError("You cannot select this username because it is already taken.");
			return null;
		}

		$result = $db->execute(
			"INSERT INTO `accounts` (
				`id`,
				`username`,
				`password`,
				`role`,
				`status`,
				`create_at`
			) VALUES (
				'$id',
				'$username',
				'$password',
				$role,
				$status,
				$create_at
			);"
		);

		$db->disconnect();

		if ($result !== TRUE) {
			parent::setError("Cannot add new record.");
			return null;
		}

		return $account;
	}

	public static function remove(string $id): bool {
		/*
			For remove a user:
			  1. Select the user
			  2. Change the status to removed
			  3. If status is already setet as removed, now delete the record
		*/

		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return false;
		}

		$result = $db->execute(
			"SELECT `status` FROM `accounts`
			WHERE `accounts`.`id` = '$id';"
		);

		if (mysqli_num_rows($result) == 0) {
			parent::setError("This id is not exists in database.");
			$db->disconnect();
			return false;
		}

		$row = mysqli_fetch_assoc($result);

		if ((int)$row["status"] === ACCOUNT_STATUS_OK) {
			$removedStatus = ACCOUNT_STATUS_REMOVED;
			$result = $db->execute(
				"UPDATE `accounts`
				SET
					`status` = $removedStatus
				WHERE `accounts`.`id` = '$id';"
			);

			$db->disconnect();
			return ($result === TRUE) ? true : false;
		}else {
			$result = $db->execute(
				"DELETE FROM `accounts` WHERE `accounts`.`id` = '$id';"
			);
			$db->disconnect();
			return ($result === TRUE) ? true : false;
		}
	}

	public static function undoRemove(string $id): bool {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return false;
		}

		$okStatus = ACCOUNT_STATUS_OK;
		$result = $db->execute(
			"UPDATE `accounts`
			SET
				`status` = $okStatus
			WHERE `accounts`.`id` = '$id';"
		);

		$db->disconnect();
		return ($result === TRUE) ? true : false;
	}

	public static function updateUsername(string $id, string $newUsername): bool {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return false;
		}

		$result = $db->execute(
			"SELECT * FROM `accounts`
			WHERE `accounts`.`username` = '$newUsername';"
		);

		if (mysqli_num_rows($result) !== 0) {
			$db->disconnect();
			parent::setError("You cannot select this username because it is already taken.");
			return false;
		}

		$result = $db->execute(
			"UPDATE `accounts`
			SET
				`username` = '$newUsername'
			WHERE `accounts`.`id` = '$id';"
		);

		$db->disconnect();
		return ($result === TRUE) ? true : false;
	}

	public static function updateRole(string $id, int $newRole): bool {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return false;
		}

		$result = $db->execute(
			"UPDATE `accounts`
			SET
				`role` = $newRole
			WHERE `accounts`.`id` = '$id';"
		);

		$db->disconnect();
		return ($result === TRUE) ? true : false;
	}

	private static function _getAccount(string $fieldName, string $value): AccountModel|null {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `accounts` WHERE `accounts`.`$fieldName` = '$value';"
		);

		if (mysqli_num_rows($result) == 0) {
			$db->disconnect();
			return null;
		}

		$row = mysqli_fetch_assoc($result);
		$db->disconnect();

		$model = new AccountModel(
			$row["username"],
			$row["password"],
			(int)($row["role"]),
			(int)($row["status"])
		);
		$model->id = $row["id"];
		$model->create_at = new DateTimeImmutable($row["create_at"]);

		return $model;
	}

	public static function get(string $id): AccountModel|null {
		return AccountRepository::_getAccount("id", $id);
	}

	public static function getByUsername(string $username): AccountModel|null {
		return AccountRepository::_getAccount("username", $username);
	}

	public static function getAll(int $page = 1, int $limit = PAGINATION_LIMIT): array|null {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$offset = ($page - 1) * $limit;
		$result = $db->execute(
			"SELECT * FROM `accounts`
			ORDER BY `username`
			LIMIT $limit OFFSET $offset;"
		);

		if (mysqli_num_rows($result) == 0) {
			return [];
		}

		$users = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$model = new AccountModel(
				$row["username"],
				$row["password"],
				(int)($row["role"]),
				(int)($row["status"])
			);
			$model->id = $row["id"];
			$model->create_at = new DateTimeImmutable($row["create_at"]);

			array_push($users, $model);
		}

		$db->disconnect();

		return $users;
	}

	public static function getAllCount(): int {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$result = $db->execute(
			"SELECT COUNT(*) AS total FROM `accounts`;"
		);

		$db->disconnect();

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return (int)$row["total"];
		} else {
			return 0;
		}
	}
}

?>
