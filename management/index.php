<?php

session_start();

include_once __DIR__ . "/../src/services/accounts.php";
include_once __DIR__ . "/../src/repositories/hotels.php";
include_once __DIR__ . "/../src/repositories/rooms.php";
include_once __DIR__ . "/../src/utils/inputcheck.php";
include_once __DIR__ . "/../src/config.php";

if (!AccountServices::isLoginAsManager() && !AccountServices::isLoginAsAdmin()) {
	header("location:" . BASE_URL);
	die;
}

$account = AccountServices::getUser();
$hotels = HotelRepository::getForOwner($account->id);
$rooms = [];

foreach ($hotels as $hotel) {
	$hotelName = $hotel->name;
	$roomModel = RoomRepository::getForHotel($hotel->id);

	foreach ($roomModel as $room) {
		array_push($rooms, [
			"hotel-name" => $hotelName,
			"room" => $room
		]);
	}
}

$pageMode = null;
$hotelModel = null;
$roomModel = null;

if (isset($_GET["mode"])) {
	$pageMode = $_GET["mode"];

	if ($pageMode === "edit-hotel") {
		if (!isset($_GET["id"])) {
			header("location:" . BASE_URL . "management/");
			die;
		}

		$hotelModel = HotelRepository::get($_GET["id"]);

		if ($hotelModel === null) {
			header("location:" . BASE_URL . "management/");
			die;
		}
	}elseif ($pageMode === "edit-room") {
		if (!isset($_GET["id"])) {
			header("location:" . BASE_URL . "management/");
			die;
		}

		$roomModel = RoomRepository::get($_GET["id"]);

		if ($roomModel === null) {
			header("location:" . BASE_URL . "management/");
			die;
		}
	}
}

$hotelFormError = null;
$roomFormError = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$action = "";

	if (isset($_POST["action"])) $action = inputcheck($_POST["action"]);

	if ($action === "add-hotel" || $action === "edit-hotel") {
		$image = $name = $description = $country = $city = $stars = "";

		if (isset($_POST["hotelName"])) $name = inputcheck($_POST["hotelName"]);
		else $hotelFormError = "The name field is not set.";

		if (isset($_POST["hotelDescription"])) $description = inputcheck($_POST["hotelDescription"]);
		else $hotelFormError = "The description field is not set.";

		if (isset($_POST["hotelCountry"])) $country = inputcheck($_POST["hotelCountry"]);
		else $hotelFormError = "The country field is not set.";

		if (isset($_POST["hotelCity"])) $city = inputcheck($_POST["hotelCity"]);
		else $hotelFormError = "The city field is not set.";

		if (isset($_POST["hotelStars"])) $stars = (int)inputcheck($_POST["hotelStars"]);
		else $hotelFormError = "The stars field is not set.";

		// Check error
		if ($roomFormError !== null) goto view;

		// Handle Image
		$target_dir = "../assets/images/hotels/";
		$target_filename = "hotel-" . count(glob($target_dir . "*")) + 1;
		$target_file = $target_dir . $target_filename;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$needRemoveOldImg = false;

		// Check if image file is a actual image or fake image
		if(isset($_FILES["hotelImage"])) {
			$target_filename .= "." . pathinfo($_FILES["hotelImage"]["name"], PATHINFO_EXTENSION);
			$target_file .=  "." . pathinfo($_FILES["hotelImage"]["name"], PATHINFO_EXTENSION);
			$image = $target_filename;

			if ($action === "edit-hotel" && $_FILES["hotelImage"]["tmp_name"] === "") {
				$image = $hotelModel->image;
				goto hotel_service;
			}elseif ($action === "edit-hotel") {
				$target_filename = $hotelModel->image;
				$target_file = $target_dir . $target_filename;
				$image = $target_filename;
				$needRemoveOldImg = true;
			}

			if(!getimagesize($_FILES["hotelImage"]["tmp_name"])) {
				$uploadOk = 0;
			}
		}else {
			$hotelFormError = "The hotel image was not uploaded.";
			goto view;
		}

		// Remove old image
		if ($needRemoveOldImg) {
			unlink($target_dir . $hotelModel->image);
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			$uploadOk = 0;
			$hotelFormError = "File is exists in file system.";
		}

		// Check file size
		if ($_FILES["hotelImage"]["size"] > 5000000) {
			$hotelFormError = "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		$imageFileType = $_FILES["hotelImage"]["type"];
		if($imageFileType != "image/jpg" && $imageFileType != "image/png" && $imageFileType != "image/jpeg" ) {
			$hotelFormError = "Sorry, only JPG, JPEG, PNG files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk !== 0 && !move_uploaded_file($_FILES["hotelImage"]["tmp_name"], $target_file)) {
			$hotelFormError = "Sorry, there was an error uploading your file.";
		}
		// Handle Image

		hotel_service:

		if ($hotelFormError !== null) {
			goto view;
		}

		if ($action === "edit-hotel") {
			$hotelModel->image = $image;
			$hotelModel->name = $name;
			$hotelModel->description = $description;
			$hotelModel->country = $country;
			$hotelModel->city = $city;
			$hotelModel->stars = $stars;

			if (!HotelRepository::update($hotelModel)) {
				$hotelFormError = HotelRepository::getError();
				goto view;
			}
		}else {
			$result = HotelRepository::create(
				$account->id,
				$image,
				$name,
				$description,
				$country,
				$city,
				$stars
			);

			if ($result === null) {
				$hotelFormError = HotelRepository::getError();
				goto view;
			}
		}
	}elseif ($action === "add-room" || $action === "edit-room") {
		$image = $hotel = $number = $description = $price = $bed = $capacity = "";

		if (isset($_POST["roomRefHotel"])) $hotel = inputcheck($_POST["roomRefHotel"]);
		else $roomFormError = "The hotel field is not set.";

		if (isset($_POST["roomNumber"])) $number = inputcheck($_POST["roomNumber"]);
		else $roomFormError = "The number field is not set.";

		if (isset($_POST["roomDescription"])) $description = inputcheck($_POST["roomDescription"]);
		else $roomFormError = "The description field is not set.";

		if (isset($_POST["roomPrice"])) $price = (int)inputcheck($_POST["roomPrice"]);
		else $roomFormError = "The price field is not set.";

		if (isset($_POST["roomBed"])) $bed = (int)inputcheck($_POST["roomBed"]);
		else $roomFormError = "The bed field is not set.";

		if (isset($_POST["roomCapacity"])) $capacity = (int)inputcheck($_POST["roomCapacity"]);
		else $roomFormError = "The capacity field is not set.";

		// Check hotel id
		if (HotelRepository::get($hotel) === null) {
			$roomFormError = "The hotel does not exist.";
		}

		// Check error
		if ($roomFormError !== null) goto view;

		// Handle Image
		$target_dir = "../assets/images/rooms/";
		$target_filename = "room-" . count(glob($target_dir . "*")) + 1;
		$target_file = $target_dir . $target_filename;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$needRemoveOldImg = false;

		// Check if image file is a actual image or fake image
		if(isset($_FILES["roomImage"])) {
			$target_filename .= "." . pathinfo($_FILES["roomImage"]["name"], PATHINFO_EXTENSION);
			$target_file .=  "." . pathinfo($_FILES["roomImage"]["name"], PATHINFO_EXTENSION);
			$image = $target_filename;

			if ($action === "edit-room" && $_FILES["roomImage"]["tmp_name"] === "") {
				$image = $roomModel->image;
				goto room_service;
			}elseif ($action === "edit-room") {
				$target_filename = $roomModel->image;
				$target_file = $target_dir . $target_filename;
				$image = $target_filename;
				$needRemoveOldImg = true;
			}

			if(!getimagesize($_FILES["roomImage"]["tmp_name"])) {
				$uploadOk = 0;
			}
		}else {
			$roomFormError = "The room image was not uploaded.";
			goto view;
		}

		// Remove old image
		if ($needRemoveOldImg) {
			unlink($target_dir . $roomModel->image);
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			$uploadOk = 0;
			$roomFormError = "File is exists in file system.";
		}

		// Check file size
		if ($_FILES["roomImage"]["size"] > 5000000) {
			$roomFormError = "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		$imageFileType = $_FILES["roomImage"]["type"];
		if($imageFileType != "image/jpg" && $imageFileType != "image/png" && $imageFileType != "image/jpeg" ) {
			$roomFormError = "Sorry, only JPG, JPEG, PNG files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk !== 0 && !move_uploaded_file($_FILES["roomImage"]["tmp_name"], $target_file)) {
			$roomFormError = "Sorry, there was an error uploading your file.";
		}
		// Handle Image

		room_service:

		if ($roomFormError !== null) {
			goto view;
		}

		if ($action === "edit-room") {
			$roomModel->image = $image;
			$roomModel->hotel = $hotel;
			$roomModel->number = $number;
			$roomModel->description = $description;
			$roomModel->price = $number;
			$roomModel->bed = $bed;
			$roomModel->capacity = $capacity;

			if (!RoomRepository::update($roomModel)) {
				$roomFormError = RoomRepository::getError();
				goto view;
			}
		}else {
			$result = RoomRepository::create(
				$hotel,
				$image,
				$description,
				$price,
				$number,
				$bed,
				$capacity
			);

			if ($result === null) {
				$roomFormError = RoomRepository::getError();
				goto view;
			}
		}
	}

	header("location:" . BASE_URL . "management/");
	die;
}

view:

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/x-icon" />
	<link href="../assets/libs/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/navbar.css" rel="stylesheet" />
	<title>Innity - Management</title>
	<style>
		/* Add Hotel Form */
		.add-hotel h4 {
			color: #333;
		}
		.add-hotel .form-label {
			color: #555;
		}
		.add-hotel .btn-primary {
			font-weight: bold;
			border-radius: 8px;
		}
		/* Add Hotel Form */

		/* Hotel Tables */
		.view-hotels h4 {
			color: #333;
		}
		.view-hotels .btn {
			border-radius: 6px;
			padding: 4px 10px;
		}
		.view-hotels .badge {
			font-size: 0.85rem;
			padding: 6px 10px;
		}
		/* Hotel Tables */
	</style>
</head>
<body>
	<?php include_once __DIR__ . "/../assets/components/navbar.php"; ?>

	<section class="add-hotel py-5">
		<div class="container">
			<h4 class="fw-bold mb-4">
				<?= $pageMode === "edit-hotel" ? "Edit Hotel" : "Add New Hotel" ?>
			</h4>
			<div class="card shadow-lg border-0 rounded-3">
				<div class="card-body p-4">
					<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . ($pageMode === "edit-hotel" ? "?mode=edit-hotel&id=$hotelModel->id" : "") ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
						<?php
						if ($pageMode === "edit-hotel") {
							echo "<input type=\"hidden\" name=\"action\" value=\"edit-hotel\" />";
						}else {
							echo "<input type=\"hidden\" name=\"action\" value=\"add-hotel\" />";
						}
						?>

						<div class="mb-3">
							<label for="hotelImage" class="form-label fw-semibold">
								<span>Hotel Image</span>
								<br />
								<?php
								if ($pageMode === "edit-hotel") {
									echo "<img class=\"img-fluid\" src=\"" . BASE_URL . "assets/images/hotels/" . $hotelModel->image . "\" />";
								}
								?>
							</label>
							<input type="file" class="form-control" name="hotelImage" id="hotelImage" accept="image/*" <?= $pageMode === "edit-hotel" ? "" : "required" ?> />
						</div>

						<div class="mb-3">
							<label for="hotelName" class="form-label fw-semibold">Hotel Name</label>
							<input type="text" class="form-control" name="hotelName" id="hotelName" value="<?= $pageMode === "edit-hotel" ? $hotelModel->name : "" ?>" placeholder="Enter hotel name" max="128" required />
						</div>

						<div class="mb-3">
							<label for="hotelDescription" class="form-label fw-semibold">Description</label>
							<textarea class="form-control" id="hotelDescription" name="hotelDescription" rows="3" placeholder="Enter hotel description" max="512" required><?= $pageMode === "edit-hotel" ? $hotelModel->description : "" ?></textarea>
						</div>

						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="hotelCountry" class="form-label fw-semibold">Country</label>
								<input type="text" class="form-control" id="hotelCountry" name="hotelCountry" value="<?= $pageMode === "edit-hotel" ? $hotelModel->country : "" ?>" placeholder="Enter country" max="64" required />
							</div>

							<div class="col-md-6 mb-3">
								<label for="hotelCity" class="form-label fw-semibold">City</label>
								<input type="text" class="form-control" id="hotelCity" name="hotelCity" value="<?= $pageMode === "edit-hotel" ? $hotelModel->city : "" ?>" placeholder="Enter city" max="64" required />
							</div>
						</div>

						<div class="mb-3">
							<label for="hotelStars" class="form-label fw-semibold">Stars</label>
							<select class="form-select" id="hotelStars" name="hotelStars" required>
								<option value="" <?= ($pageMode === "edit-hotel" && $hotelModel->stars === 0) ? "selected" : "" ?>>Select stars</option>
								<option value="1" <?= ($pageMode === "edit-hotel" && $hotelModel->stars === 1) ? "selected" : "" ?>>1 Star</option>
								<option value="2" <?= ($pageMode === "edit-hotel" && $hotelModel->stars === 2) ? "selected" : "" ?>>2 Stars</option>
								<option value="3" <?= ($pageMode === "edit-hotel" && $hotelModel->stars === 3) ? "selected" : "" ?>>3 Stars</option>
								<option value="4" <?= ($pageMode === "edit-hotel" && $hotelModel->stars === 4) ? "selected" : "" ?>>4 Stars</option>
								<option value="5" <?= ($pageMode === "edit-hotel" && $hotelModel->stars === 5) ? "selected" : "" ?>>5 Stars</option>
							</select>
						</div>

						<small class="d-block text-center text-danger my-3 mt-4"><?= $hotelFormError ?></small>

						<button type="submit" class="btn btn-primary px-4 w-100">
							<?= $pageMode === "edit-hotel" ? "Edit Hotel" : "Add Hotel" ?>
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<hr />

	<section class="view-hotels py-5">
		<div class="container">
			<h4 class="fw-bold mb-4">View Hotels</h4>
			<div class="card shadow-lg border-0 rounded-3">
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover align-middle mb-0">
							<thead class="table-light">
								<tr class="text-center">
									<th>#</th>
									<th>Image</th>
									<th>Name</th>
									<th>Location</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>

								<?php
								$isn = 0;
								foreach ($hotels as $model) {
									$isn++;
									$status = $model->status;
									$statusColor = "bg-success";
									$removedText = "Remove";
									$undoLock = "";

									if ($status === HOTEL_STATUS_OK) {
										$status = "OK";
										$undoLock = "disabled";
									}elseif ($status === HOTEL_STATUS_REMOVED) {
										$status = "REMOVED";
										$statusColor = "bg-danger";
										$removedText = "Delete";
									}
								?>
								<tr class="text-center">
									<td><?= $isn ?></td>
									<td>
										<img src="../assets/images/hotels/<?= $model->image ?>" alt="Hotel" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
									</td>
									<td><?= $model->name ?></td>
									<td><?= $model->country . ", " . $model->city ?></td>
									<td><span class="badge <?= $statusColor ?>"><?= $status ?></span></td>
									<td>
										<a href="<?= BASE_URL ?>hotel/?id=<?= $model->id ?>" class="btn btn-sm btn-info text-white">View</a>
										<a href="<?= BASE_URL ?>management/?mode=edit-hotel&id=<?= $model->id ?>" class="btn btn-sm btn-warning text-white">Update</a>
										<a href="<?= BASE_URL ?>controllers/hotel.php/?action=remove&id=<?= $model->id ?>&redirect=<?= BASE_URL . "management/" ?>" class="btn btn-sm btn-danger"><?= $removedText ?></a>
										<a href="<?= BASE_URL ?>controllers/hotel.php/?action=undo&id=<?= $model->id ?>&redirect=<?= BASE_URL . "management/" ?>" class="btn btn-sm btn-success <?= $undoLock ?>">Undo</a>
									</td>
								</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<hr />

	<section class="add-hotel py-5">
		<div class="container">
			<h4 class="fw-bold mb-4" id="form-room">
				<?= $pageMode === "edit-room" ? "Edit Room" : "Add New Room" ?>
			</h4>
			<div class="card shadow-lg border-0 rounded-3">
				<div class="card-body p-4">
					<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . ($pageMode === "edit-room" ? "?mode=edit-room&id=$roomModel->id" : "") ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
						<?php
						if ($pageMode === "edit-room") {
							echo "<input type=\"hidden\" name=\"action\" value=\"edit-room\" />";
						}else {
							echo "<input type=\"hidden\" name=\"action\" value=\"add-room\" />";
						}
						?>

						<div class="mb-3">
							<label for="roomImage" class="form-label fw-semibold">
								<span>Room Image</span>
								<br />
								<?php
								if ($pageMode === "edit-room") {
									echo "<img class=\"img-fluid\" src=\"" . BASE_URL . "assets/images/rooms/" . $roomModel->image . "\" />";
								}
								?>
							</label>
							<input type="file" class="form-control" name="roomImage" id="roomImage" accept="image/*" <?= $pageMode === "edit-room" ? "" : "required" ?> />
						</div>

						<div class="mb-3">
							<label for="roomRefHotel" class="form-label fw-semibold">Hotel</label>
							<select class="form-select" name="roomRefHotel" id="roomRefHotel" required>
								<option value="">Select hotels</option>
								<?php
								foreach ($hotels as $hotel) {
								?>
								<option value="<?= $hotel->id ?>" <?= ($roomModel !== null && $hotel->id === $roomModel->hotel) ? "selected" : "" ?>><?= $hotel->name ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="mb-3">
							<label for="roomNumber" class="form-label fw-semibold">Room Number</label>
							<input type="number" class="form-control" name="roomNumber" id="roomNumber" value="<?= $roomModel !== null ? $roomModel->number : "" ?>" placeholder="Enter room number" required />
						</div>

						<div class="mb-3">
							<label for="roomDescription" class="form-label fw-semibold">Description</label>
							<textarea class="form-control" name="roomDescription" id="roomDescription" rows="3" placeholder="Enter room description" max="512" required><?= $roomModel !== null ? $roomModel->description : "" ?></textarea>
						</div>

						<div class="mb-3">
							<label for="roomPrice" class="form-label fw-semibold">Room Price</label>
							<input type="number" class="form-control" name="roomPrice" id="roomPrice" value="<?= $roomModel !== null ? $roomModel->price : "" ?>" placeholder="Enter room price" required />
						</div>

						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="roomBed" class="form-label fw-semibold">Bed</label>
								<input type="number" class="form-control" name="roomBed" id="roomBed" value="<?= $roomModel !== null ? $roomModel->bed : "" ?>" placeholder="Enter country" required />
							</div>

							<div class="col-md-6 mb-3">
								<label for="roomCapacity" class="form-label fw-semibold">Capacity</label>
								<input type="number" class="form-control" name="roomCapacity" id="roomCapacity" value="<?= $roomModel !== null ? $roomModel->capacity : "" ?>" placeholder="Enter city" required />
							</div>
						</div>

						<small class="d-block text-center text-danger my-3 mt-4"><?= $roomFormError ?></small>

						<button type="submit" class="btn btn-primary px-4 w-100">
							<?= $pageMode === "edit-room" ? "Edit Room" : "Add Room" ?>
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<hr />

	<section class="view-hotels py-5">
		<div class="container">
			<h4 class="fw-bold mb-4">View Rooms</h4>
			<div class="card shadow-lg border-0 rounded-3">
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover align-middle mb-0">
							<thead class="table-light">
								<tr class="text-center">
									<th>#</th>
									<th>Image</th>
									<th>Hotel Name</th>
									<th>Room Number</th>
									<th>Bed Count</th>
									<th>Capacity</th>
									<th>Reseved At</th>
									<th>Reseved Duration</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>

								<?php
								$isn = 0;
								foreach ($rooms as $row) {
									$isn++;
									$room = $row["room"];
									$hotel = $row["hotel-name"];
									$resevedAt = $room->reserved_time;
									$resevedDuration = $room->reserved_for;
									$status = $room->status;

									$statusColor = "bg-success";
									$removedText = "Remove";
									$undoLock = "disabled";

									if ($resevedAt === null) $resevedAt = "None";
									else $resevedAt = $resevedAt->format("Y/m/d");

									if ($resevedDuration === null) $resevedDuration = "None";
									else $resevedDuration .= " Nights";

									if ($status === ROOMS_STATUS_OK) $status = "OK";
									elseif ($status === ROOMS_STATUS_REMOVED) {
										$status = "REMOVED";
										$statusColor = "bg-danger";
										$removedText = "Delete";
										$undoLock = "";
									}
								?>
								<tr class="text-center">
									<td><?= $isn ?></td>
									<td>
										<img src="../assets/images/rooms/<?= $room->image ?>" alt="Hotel" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
									</td>
									<td><?= $hotel ?></td>
									<td><span class="badge bg-primary">#<?= $room->number ?></span></td>
									<td><span class="badge bg-primary"><?= $room->bed ?></span></td>
									<td><span class="badge bg-primary"><?= $room->capacity ?></span></td>
									<td><?= $resevedAt ?></td>
									<td><?= $resevedDuration ?></td>
									<td><span class="badge <?= $statusColor ?>"><?= $status ?></span></td>
									<td>
										<div class="btn-group">
											<a href="<?= BASE_URL ?>reserve/?id=<?= $room->id ?>&mode=view" class="btn btn-sm btn-info text-white">View</a>
											<a href="<?= BASE_URL ?>management/?mode=edit-room&id=<?= $room->id ?>#form-room" class="btn btn-sm btn-warning text-white">Update</a>
											<a href="<?= BASE_URL ?>controllers/room.php?action=remove&id=<?= $room->id ?>&redirect=<?= BASE_URL . "management/" ?>" class="btn btn-sm btn-danger"><?= $removedText ?></a>
											<a href="<?= BASE_URL ?>controllers/room.php?action=undo&id=<?= $room->id ?>&redirect=<?= BASE_URL . "management/" ?>" class="btn btn-sm btn-success <?= $undoLock ?>">Undo</a>
										</div>
									</td>
								</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include_once __DIR__ . "/../assets/components/footer.php"; ?>

	<script src="../assets/libs/bootstrap.bundle.min.js"></script>
</body>
</html>
