<?php

session_start();

include_once __DIR__ . "/../src/services/accounts.php";
include_once __DIR__ . "/../src/repositories/rooms.php";
include_once __DIR__ . "/../src/models/accounts.php";
include_once __DIR__ . "/../src/models/rooms.php";
include_once __DIR__ . "/../src/config.php";

$redirect = BASE_URL;
$action = null;
$id = null;

$account = AccountServices::getUser();

if (isset($_GET["redirect"])) $redirect = $_GET["redirect"];
if (isset($_GET["action"])) $action = $_GET["action"];
if (isset($_GET["id"])) $id = $_GET["id"];

if ($account === null || $action === null || $id === null) {
	goto out;
}

$model = RoomRepository::get($id);

if ($model === null || ($model->reserved_by !== $account->id && $account->role !== ACCOUNT_ROLE_ADMIN && $account->role !== ACCOUNT_ROLE_MANAGER)) {
	die;
	goto out;
}

if ($action === "cancel") {
	$model->reserved_by = null;
	$model->reserved_time = null;
	$model->reserved_for = null;

	RoomRepository::update($model);
}elseif ($action === "remove") {
	if ($model->status === ROOMS_STATUS_REMOVED) {
		// Remove room image from file system
		unlink("../assets/images/rooms/" . $model->image);
	}

	RoomRepository::remove($id);
}elseif ($action === "undo") {
	RoomRepository::undoRemove($id);
}

out:
header("location:$redirect");
die;

?>
