<?php

session_start();

include_once __DIR__ . "/../src/repositories/hotels.php";
include_once __DIR__ . "/../src/services/hotels.php";

$currentPage = 1;
if (isset($_GET["page"])) {
	$currentPage = (int)$_GET["page"];
}

// Get Search Queries
$searchName = null;
$searchStars = null;
$searchCountry = null;
$searchCity = null;
$searchQuery = "";
if (isset($_GET["hotel"])) {
	$hotel = $_GET["hotel"];
	if ($hotel !== "") {
		$searchQuery .= "hotel=" . $hotel;
		$searchName = $hotel;
	}
}
if (isset($_GET["stars"])) {
	$stars = $_GET["stars"];
	if ($stars !== "") {
		if ($searchQuery !== "") $searchQuery .= "&";
		$searchQuery .= "stars=" . $stars;
		$searchStars = $stars;
	}
}
if (isset($_GET["country"])) {
	$country = $_GET["country"];
	if ($country !== "") {
		if ($searchQuery !== "") $searchQuery .= "&";
		$searchQuery .= "country=" . $country;
		$searchCountry = $country;
	}
}
if (isset($_GET["city"])) {
	$city = $_GET["city"];
	if ($city !== "") {
		if ($searchQuery !== "") $searchQuery .= "&";
		$searchQuery .= "city=" . $city;
		$searchCity = $city;
	}
}
if ($searchQuery !== "") $searchQuery = "&" . $searchQuery;

// Get Models
if ($searchStars !== null) $searchStars = (int)$searchStars;

$hotelsModels = HotelRepository::getAll(
	$currentPage,
	PAGINATION_LIMIT,
	$searchName,
	$searchStars,
	$searchCountry,
	$searchCity
);
$hotelsModelsCount = count($hotelsModels);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/x-icon" />
	<link href="../assets/libs/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/navbar.css" rel="stylesheet" />
	<title>Innity - Hotels</title>
	<style>
		.card-img-top {
			max-height: 215px;
		}
	</style>
</head>
<body>
	<?php include_once __DIR__ . "/../assets/components/navbar.php"; ?>

	<section class="bg-light py-4 shadow-sm">
		<div class="container">
			<form class="row g-3 align-items-end justify-content-around" method="GET">
				<div class="col-md-3">
					<label for="hotelName" class="form-label">Hotel Name</label>
					<input type="text" class="form-control" id="hotelName" name="hotel" value="<?= $searchName ?>" placeholder="e.g. Grand Palace" />
				</div>

				<div class="col-md-2">
					<label for="stars" class="form-label">Stars</label>
					<select class="form-select" id="stars" name="stars">
						<option value="" <?= $searchStars === null ? "selected" : "" ?>>Any</option>
						<option value="5" <?= $searchStars === 5 ? "selected" : "" ?>>★★★★★</option>
						<option value="4" <?= $searchStars === 4 ? "selected" : "" ?>>★★★★</option>
						<option value="3" <?= $searchStars === 3 ? "selected" : "" ?>>★★★</option>
						<option value="2" <?= $searchStars === 2 ? "selected" : "" ?>>★★</option>
						<option value="1" <?= $searchStars === 1 ? "selected" : "" ?>>★</option>
					</select>
				</div>

				<div class="col-md-2">
					<label for="country" class="form-label">Country</label>
					<input type="text" class="form-control" id="country" name="country" value="<?= $searchCountry ?>" placeholder="e.g. Germany" />
				</div>

				<div class="col-md-2">
					<label for="city" class="form-label">City</label>
					<input type="text" class="form-control" id="city" name="city" value="<?= $searchCity ?>" placeholder="e.g. Berlin" />
				</div>

				<div class="col-md-1">
					<button type="submit" class="btn btn-primary px-4">Search</button>
				</div>
			</form>
		</div>
	</section>

	<section class="py-5">
		<div class="container">
			<div class="row g-4">

				<?php
					foreach ($hotelsModels as $model) {
				?>
				<div class="col-md-4">
					<div class="card h-100 shadow-sm">
						<img src="../assets/images/hotels/<?= $model->image ?>" class="card-img-top" alt="Hotel Image" />

						<div class="card-body">
							<h5 class="card-title"><?= $model->name ?></h5>
							<p class="card-text" style="font-size: 14px;"><?= $model->description ?></p>

							📍 <span class="badge bg-dark mb-2"><?= $model->country . ' - ' . $model->city ?></span>

							<div class="mb-3">
								<span class="text-warning">
									<?php
									for ($i = 0; $i < $model->stars; $i++) {
										echo "★";
									}
									for ($i = 5 - $model->stars; $i > 0; $i--) {
										echo "☆";
									}
									?>
								</span>
							</div>

							<a href="<?= BASE_URL ?>hotel/?id=<?= $model->id ?>" class="btn btn-sm btn-primary w-100">View Hotel</a>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>
		</div>
	</section>

	<div aria-label="Hotels Pagination">
		<?php
			$pageCount = HotelsServices::getPageCount(
				$searchName,
				$searchStars,
				$searchCountry,
				$searchCity
			);
			$previous = $currentPage - 1;
			$next = $currentPage + 1;
			$previousLock = "";
			$nextLock = "";

			if ($previous <= 0)
				$previousLock = "disabled";
			if ($next - 1 >= $pageCount)
				$nextLock = "disabled";
		?>

		<ul class="pagination justify-content-center mt-4">
			<li class="page-item <?= $previousLock ?>">
				<a class="page-link" href="?page=<?= $previous ?><?= $searchQuery ?>" tabindex="<?= $previous ?>">&laquo;</a>
			</li>

			<?php
				for ($page = 1; $page < $pageCount + 1; $page++) {
					$active = "";
					if ($page === $currentPage) $active = " active";
			?>
			<li class="page-item<?= $active ?>"><a class="page-link" href="?page=<?= $page ?><?= $searchQuery ?>"><?= $page ?></a></li>
			<?php } ?>

			<li class="page-item <?= $nextLock ?>">
				<a class="page-link" href="?page=<?= $next ?><?= $searchQuery ?>" tabindex="<?= $next ?>">&raquo;</a>
			</li>
		</ul>
	</div>

	<?php include_once __DIR__ . "/../assets/components/footer.php"; ?>

	<script src="../assets/libs/bootstrap.bundle.min.js"></script>
</body>
</html>
