<?php

session_start();

include_once __DIR__ . "/../src/repositories/hotels.php";
include_once __DIR__ . "/../src/repositories/rooms.php";
include_once __DIR__ . "/../src/services/hotels.php";
include_once __DIR__ . "/../src/services/rooms.php";
include_once __DIR__ . "/../src/config.php";

$hotelId = null;

if (isset($_GET["id"])) {
	$hotelId = $_GET["id"];
}

if ($hotelId === null) {
	header("location:" . BASE_URL);
	die;
}

$hotelModel = HotelRepository::get($hotelId);
$roomsModels = RoomRepository::getForHotel($hotelId);

if ($hotelModel === null || $roomsModels === null) {
	header("location:" . BASE_URL);
	die;
}

$currentPage = 1;
if (isset($_GET["page"])) {
	$currentPage = (int)$_GET["page"];
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
	<title>Innity - Hotel</title>
	<style>
		/* Header */
		.hotel-header {
			position: relative;
			background-size: cover;
			background-position: center;
			color: white;
			padding: 80px 30px;
		}

		.hotel-header::before {
			content: "";
			position: absolute;
			top: 0; left: 0;
			width: 100%; height: 100%;
			background: rgba(0, 0, 0, 0.5);
			z-index: 1;
		}

		.hotel-header .content {
			position: relative;
			z-index: 2;
		}

		.hotel-header h1 {
			font-size: 3rem;
			font-weight: bold;
		}

		.hotel-header p.short-desc {
			font-size: 1.2rem;
			max-width: 600px;
		}

		.hotel-info {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-top: 20px;
			flex-wrap: wrap;
		}

		.hotel-location {
			font-size: 1.1rem;
		}

		.hotel-stars {
			font-size: 1.3rem;
			color: gold;
		}
		/* Header */

		/* Hotel Description */
		.hotel-description h2 {
			font-size: 2rem;
			font-weight: bold;
			border-bottom: 2px solid #ddd;
			padding-bottom: 10px;
		}

		.hotel-description p {
			font-size: 1.1rem;
			line-height: 1.8;
			color: #555;
			text-align: justify;
		}
		/* Hotel Description */

		/* Rooms Card */
		.rooms .card img {
			height: 200px;
			object-fit: cover;
		}

		.rooms .card-text {
			font-size: 0.95rem;
			color: #555;
		}

		.rooms .btn-primary {
			background-color: #007bff;
			border: none;
			font-weight: bold;
		}

		.rooms .btn-primary:hover {
			background-color: #0056b3;
		}
		/* Rooms Card */
	</style>
</head>
<body>
	<?php include_once __DIR__ . "/../assets/components/navbar.php"; ?>

	<header class="hotel-header" style="background-image: url('../assets/images/hotels/<?= $hotelModel->image ?>');">
		<div class="container content">
			<h1><?= $hotelModel->name ?></h1>
			<p class="short-desc"><?= $hotelModel->description ?></p>

			<div class="hotel-info">
				<div class="hotel-location">
					📍 <?= $hotelModel->country . ", " . $hotelModel->city ?>
				</div>
				<div class="hotel-stars">
					<?php
					for ($i = 0; $i < $hotelModel->stars; $i++) {
						echo "★";
					}
					for ($i = 5 - $hotelModel->stars; $i > 0; $i--) {
						echo "☆";
					}
					?>
				</div>
			</div>
		</div>
	</header>

	<section class="hotel-description py-5">
		<div class="container">
			<h2 class="mb-4"><?= $hotelModel->name ?></h2>
			<p>
				<?= $hotelModel->description ?>
			</p>
		</div>
	</section>

	<hr />

	<section class="rooms py-5">
		<div class="container">
			<div class="row g-4">
				<h2>Rooms</h2>

				<?php
				foreach ($roomsModels as $room) {
					if ($room->reserved_by !== null) continue;
				?>
				<div class="col-md-4">
					<div class="card h-100 shadow-sm">
						<img src="../assets/images/rooms/<?= $room->image ?>" class="card-img-top" alt="Room Image">

						<div class="card-body">
							<p class="card-text"><?= $room->description ?></p>

							<ul class="list-unstyled mb-3">
								<li><strong>Bed Count:</strong> <?= $room->bed ?></li>
								<li><strong>Capacity:</strong> <?= $room->capacity ?></li>
								<li><strong>Price:</strong> $<?= $room->price ?></li>
							</ul>

							<a href="<?= BASE_URL ?>reserve/?id=<?= $room->id ?>" class="btn btn-primary w-100">Reserve</a>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>
		</div>
	</section>

	<?php include_once __DIR__ . "/../assets/components/footer.php"; ?>

	<script src="../assets/libs/bootstrap.bundle.min.js"></script>
</body>
</html>
