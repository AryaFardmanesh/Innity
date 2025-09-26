<?php

abstract class Service {
	private static string|null $error = null;

	protected static function setError(string $msg): void {
		self::$error = $msg;
	}

	public static function getError(): string|null {
		$err = self::$error;
		self::$error = null;
		return $err;
	}
}

?>
