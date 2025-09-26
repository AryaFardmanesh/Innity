<?php

session_start();

include_once __DIR__ . "/../src/services/accounts.php";
include_once __DIR__ . "/../src/repositories/rooms.php";
include_once __DIR__ . "/../src/utils/inputcheck.php";
include_once __DIR__ . "/../src/config.php";

$account = AccountServices::getUser();

if (!AccountServices::isLogin() || !isset($_GET["id"])) {
	header("location:" . BASE_URL . "login/");
	die;
}

$roomId = $_GET["id"];
$roomModel = RoomRepository::get($roomId);

if ($roomModel === null) {
	header("location:" . BASE_URL . "hotels/");
	die;
}

$mode = null;
$formError = "";

if (isset($_GET["mode"]) && $_GET["mode"] === "view") {
	$mode = "view";
}else {
	if ($roomModel->reserved_by !== null) {
		header("location:" . BASE_URL . "hotels/");
		die;
	}

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$checkin = $nights = "";

		if (isset($_POST["checkin"])) $checkin = inputcheck($_POST["checkin"]);
		else $usernameError = "The checkin field is not set.";

		if (isset($_POST["nights"])) $nights = (int)inputcheck($_POST["nights"]);
		else $passwordError = "The nights field is not set.";

		$roomModel->reserved_by = $account->id;
		$roomModel->reserved_time = new DateTimeImmutable($checkin);
		$roomModel->reserved_for = $nights;

		if (!RoomRepository::update($roomModel)) {
			$formError = RoomRepository::getError();
		}else {
			header("location:" . BASE_URL . "profile/");
			die;
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/x-icon" />
	<link href="../assets/libs/bootstrap.min.css" rel="stylesheet" />
	<title>Innity - Reserve</title>
	<style>
		.reserve-page {
			background: #f8f9fa;
			min-height: 100vh;
		}

		.reserve-page .card {
			border: none;
		}

		.reserve-page .btn-primary {
			font-weight: bold;
			font-size: 1rem;
			background-color: #007bff;
			border: none;
		}

		.reserve-page .btn-primary:hover {
			background-color: #0056b3;
		}
	</style>
</head>
<body>
	<section class="reserve-page d-flex align-items-center justify-content-center py-5">
		<div class="card shadow-lg" style="max-width: 500px; width: 100%; border-radius: 15px; overflow: hidden;">
			<div class="position-relative">
				<img src="../assets/images/rooms/<?= $roomModel->image ?>" class="w-100" style="height: 250px; object-fit: cover;" alt="Room Image">

				<div class="position-absolute bottom-0 start-0 w-100 p-3 text-white" style="background: rgba(0,0,0,0.5);">
					<h5 class="mb-1">Room #<?= $roomModel->number ?></h5>
					<small><strong>Beds:</strong> <?= $roomModel->bed ?> | <strong>Capacity:</strong> <?= $roomModel->capacity ?></small><br>
					<small><strong>Price per Night:</strong> $<?= $roomModel->price ?></small>
				</div>
			</div>

			<div class="card-body">
				<?php if ($mode !== "view") { ?>
				<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $roomId) ?>" method="POST" autocomplete="off">
					<div class="mb-3">
						<label for="checkin" class="form-label">Check-in Date</label>
						<input type="date" id="checkin" name="checkin" class="form-control" required />
					</div>

					<div class="mb-3">
						<label for="nights" class="form-label">Number of Nights</label>
						<input type="number" id="nights" name="nights" min="1" value="1" class="form-control" required />
					</div>

					<small class="d-block my-2 text-center text-danger"><?= $formError ?></small>

					<button type="submit" class="btn btn-primary w-100 py-2">Reserve Now</button>
				</form>
				<?php } ?>
			</div>
		</div>
	</section>

	<script src="../assets/libs/bootstrap.bundle.min.js"></script>
</body>
</html>
