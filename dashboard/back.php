<?php

session_start();

include_once __DIR__ . "/../src/services/accounts.php";
include_once __DIR__ . "/../src/models/accounts.php";
include_once __DIR__ . "/../src/config.php";

$account = AccountServices::getUser();

if ($account === null || $account->role !== ACCOUNT_ROLE_ADMIN) {
	header("location:" . BASE_URL);
}

?>
