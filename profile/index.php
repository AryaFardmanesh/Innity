<?php

session_start();

include_once __DIR__ . "/../src/models/accounts.php";
include_once __DIR__ . "/../src/repositories/accounts.php";
include_once __DIR__ . "/../src/repositories/hotels.php";
include_once __DIR__ . "/../src/repositories/rooms.php";
include_once __DIR__ . "/../src/services/accounts.php";
include_once __DIR__ . "/../src/config.php";

$account = AccountServices::getUser();

if ($account === null || $account->role !== ACCOUNT_ROLE_ADMIN) {
	header("location:" . BASE_URL . "login/");
}

$roomsReserved = RoomRepository::getReservedRoomsForUser($account->id);

$formError = "";
$username = $account->username;
$role = $account->role;

if ($role === ACCOUNT_ROLE_NORMAL) $role = "Normal";
elseif ($role === ACCOUNT_ROLE_MANAGER) $role = "Manager";
elseif ($role === ACCOUNT_ROLE_ADMIN) $role = "Admin";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$newUsername = "";

	if (isset($_POST["username"])) $newUsername = $_POST["username"];
	else $formError = "The username field is not set.";

	if (!AccountRepository::updateUsername($account->id, $newUsername)) {
		$formError = AccountRepository::getError();
	}else {
		header("location:" . BASE_URL . "profile/");
		die;
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
	<link href="../assets/css/navbar.css" rel="stylesheet" />
	<title>Innity - Profile</title>
	<style>
		/* Profile */
		.profile-box {
			background-color: #f8f9fa;
			min-height: 60vh;
		}

		.profile-box .card {
			border: none;
		}

		.profile-box .btn-success {
			font-weight: bold;
			font-size: 1rem;
		}

		.profile-box .badge {
			font-size: 0.9rem;
		}
		/* Profile */

		/* Reserve Table */
		.reservations h4 {
			color: #333;
		}
		.reservations .btn-danger {
			font-weight: bold;
		}
		/* Reserve Table */
	</style>
</head>
<body>
	<?php include_once __DIR__ . "/../assets/components/navbar.php"; ?>

	<section class="profile-box py-5">
		<div class="container">
			<div class="card shadow-lg" style="max-width: 500px; margin: auto; border-radius: 15px; overflow: hidden;">
				<div class="card-header bg-success text-light text-center">
					<h4 class="mb-0">My Profile</h4>
				</div>

				<div class="card-body">
					<form action="<?= htmlspecialchars(BASE_URL . "profile/") ?>" method="POST" autocomplete="off">
						<div class="mb-3">
							<label for="username" class="form-label fw-bold">Username:</label>
							<input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" min="4" max="64" spellcheck="false" required />
						</div>

						<div class="mb-3">
							<label class="form-label fw-bold">Password:</label><br />
							<span class="badge bg-danger px-3 py-2">Secret</span>
						</div>

						<div class="mb-4">
							<label class="form-label fw-bold">Role</label><br>
							<span class="badge bg-primary px-3 py-2"><?= $role ?></span>
						</div>

						<small class="d-block my-2 mb-3 text-center text-danger"><?= $formError ?></small>

						<button type="submit" class="btn btn-success w-100 py-2">Update</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<section class="reservations py-5">
		<div class="container">
			<h4 class="mb-4 fw-bold">My Reservations</h4>
			<div class="table-responsive shadow-sm rounded">
				<table class="table table-hover align-middle">
					<thead class="table-primary">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Room</th>
							<th scope="col">Hotel Name</th>
							<th scope="col">Total Price</th>
							<th scope="col">Location</th>
							<th scope="col">Start Date</th>
							<th scope="col">Duration</th>
							<th scope="col">Action</th>
						</tr>
					</thead>

					<tbody>

						<?php
						$isn = 0;
						foreach ($roomsReserved as $room) {
							$hotelModel = HotelRepository::get($room->hotel);
							$isn++;
							$total = $room->price * $room->reserved_for;
						?>
						<tr>
							<th scope="row"><?= $isn ?></th>
							<td>
								<img src="../assets/images/rooms/<?= $room->image ?>" alt="Room" style="width: 60px; height: 40px; object-fit: cover; border-radius: 5px;">
							</td>
							<td><?= $hotelModel !== null ? $hotelModel->name : "Unknown" ?></td>
							<td>$<?= $total ?></td>
							<td><?= $hotelModel !== null ? $hotelModel->country . ", " . $hotelModel->city : "Unknown" ?></td>
							<td><?= $room->reserved_time->format("Y/m/d") ?></td>
							<td><?= $room->reserved_for ?> Nights</td>
							<td>
								<a href="<?= BASE_URL ?>controllers/room.php?action=cancel&id=<?= $room->id ?>&redirect=<?= BASE_URL ?>profile" class="btn btn-danger btn-sm">Cancel</a>
							</td>
						</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>
	</section>

	<?php include_once __DIR__ . "/../assets/components/footer.php"; ?>

	<script src="../assets/libs/bootstrap.bundle.min.js"></script>
</body>
</html>
