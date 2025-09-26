<?php

session_start();

include_once __DIR__ . "/../src/services/accounts.php";
include_once __DIR__ . "/../src/models/accounts.php";
include_once __DIR__ . "/../src/models/hotels.php";
include_once __DIR__ . "/../src/repositories/hotels.php";
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

$model = HotelRepository::get($id);

if ($model === null || ($model->owner !== $account->id && $account->role !== ACCOUNT_ROLE_ADMIN)) {
	goto out;
}

if ($action === "remove") {
	// Remove hotel image from file system
	if ($model->status === HOTEL_STATUS_REMOVED) {
		unlink("../assets/images/hotels/" . $model->image);
	}

	// Remove model from database
	HotelRepository::remove($id);
}elseif ($action === "undo") {
	HotelRepository::undoRemove($id);
}

out:
header("location:$redirect");
die;

?>
