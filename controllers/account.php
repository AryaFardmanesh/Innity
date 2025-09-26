<?php

include_once __DIR__ . "/../src/repositories/accounts.php";
include_once __DIR__ . "/../src/config.php";

$redirect = BASE_URL;
$action = null;
$id = null;

if (isset($_GET["redirect"])) $redirect = $_GET["redirect"];
if (isset($_GET["action"])) $action = $_GET["action"];
if (isset($_GET["id"])) $id = $_GET["id"];

if ($action === null || $id === null) {
	goto out;
}

$model = AccountRepository::get($id);

if ($model === null) {
	goto out;
}

if ($action === "chgrade") {
	$newRole = ACCOUNT_ROLE_NORMAL;

	if ($model->role === ACCOUNT_ROLE_NORMAL) $newRole = ACCOUNT_ROLE_MANAGER;
	elseif ($model->role === ACCOUNT_ROLE_MANAGER) $newRole = ACCOUNT_ROLE_ADMIN;
	elseif ($model->role === ACCOUNT_ROLE_ADMIN) $newRole = ACCOUNT_ROLE_NORMAL;

	AccountRepository::updateRole($id, $newRole);
}elseif ($action === "remove") {
	AccountRepository::remove($id);
}elseif ($action === "undo") {
	AccountRepository::undoRemove($id);
}

out:
header("location:$redirect");
die;

?>
