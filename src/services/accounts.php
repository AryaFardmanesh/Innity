<?php

include_once __DIR__ . "/service.php";
include_once __DIR__ . "/../repositories/accounts.php";
include_once __DIR__ . "/../utils/jwt.php";
include_once __DIR__ . "/../config.php";

class AccountServices extends Service {
	public static function login(string $username, string $password): bool {
		$account = AccountRepository::getByUsername($username);

		if ($account === null) {
			parent::setError("This login information is incorrect.");
			return false;
		}

		if (!password_verify($password, $account->password)) {
			parent::setError("This login information is incorrect.");
			return false;
		}

		if ($account->status === ACCOUNT_STATUS_REMOVED) {
			parent::setError("Your account was removed.");
			return false;
		}

		$token = JWT::encode([
			"id" => $account->id,
			"username" => $account->username
		]);

		$_SESSION[SESSION_TOKEN_NAME] = $token;

		return true;
	}

	public static function signup(string $username, string $password, string $role): bool {
		$password = password_hash($password, PASSWORD_BCRYPT);

		$roleCode = ACCOUNT_ROLE_NORMAL;
		if ($role === "manager") {
			$roleCode = ACCOUNT_ROLE_MANAGER;
		}

		$account = AccountRepository::create($username, $password, $roleCode);

		if ($account === null) {
			parent::setError(AccountRepository::getError());
			return false;
		}

		$token = JWT::encode([
			"id" => $account->id,
			"username" => $username
		]);

		$_SESSION[SESSION_TOKEN_NAME] = $token;

		return true;
	}

	public static function isLogin(): bool {
		if (isset($_SESSION[SESSION_TOKEN_NAME]) && JWT::decode($_SESSION[SESSION_TOKEN_NAME]) !== null)
			return true;
		return false;
	}

	public static function isLoginAsAdmin(): bool {
		$account = AccountServices::getUser();

		if ($account === null) return false;

		return ($account->role === ACCOUNT_ROLE_ADMIN) ? true : false;
	}

	public static function isLoginAsManager(): bool {
		$account = AccountServices::getUser();

		if ($account === null) return false;

		return ($account->role === ACCOUNT_ROLE_MANAGER) ? true : false;
	}

	public static function redirectIfIsLogin(string $to): void {
		if (AccountServices::isLogin()) {
			header("location:$to");
		}
	}

	public static function getUser(): AccountModel|null {
		if (!AccountServices::isLogin()) {
			return null;
		}

		$tokenPayload = JWT::decode($_SESSION[SESSION_TOKEN_NAME]);
		return AccountRepository::get($tokenPayload["body"]["id"]);
	}

	public static function getAllUser(int $page): array {
		$models = AccountRepository::getAll($page);
		if ($models === null)
			return [];
		return $models;
	}

	public static function getPageCount(): int {
		$recordCount = AccountRepository::getAllCount();
		if ($recordCount < PAGINATION_LIMIT)
			return 1;
		return (int)ceil($recordCount / PAGINATION_LIMIT);
	}
}

?>
