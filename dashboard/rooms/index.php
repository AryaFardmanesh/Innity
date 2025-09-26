<?php

include_once __DIR__ . "/../back.php";
include_once __DIR__ . "/../../src/repositories/hotels.php";
include_once __DIR__ . "/../../src/repositories/rooms.php";
include_once __DIR__ . "/../../src/services/rooms.php";

$currentPage = 1;
if (isset($_GET["page"])) {
	$currentPage = (int)$_GET["page"];
}

$roomsModels = RoomRepository::getAll($currentPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="../../assets/images/logo/logo.png" type="image/x-icon" />
	<link href="../../assets/libs/bootstrap.min.css" rel="stylesheet" />
	<link href="../../assets/css/navbar.css" rel="stylesheet" />
	<link href="../../assets/css/asidebar.css" rel="stylesheet" />
	<title>Innity - Dashboard - Accounts</title>
	<style>
	.pagination-rounded .page-link {
		border-radius: 50% !important;
		width: 38px;
		height: 38px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.pagination-rounded .page-item.active .page-link {
		background-color: #0d6efd;
		border-color: #0d6efd;
		color: white;
	}

	a.link-primary:hover {
		color: #0a58ca;
	}

	a.link-success:hover {
		color: #19692c;
	}

	a.link-warning:hover {
		color: #b36b00;
	}

	a.link-danger:hover {
		color: #842029;
	}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 p-0">
				<?php include_once __DIR__ . "/../../assets/components/navbar.php"; ?>
			</div>

			<div class="col-12 col-md-2 p-0">
				<?php
					$AsideBarSetting_ActiveLink = "rooms";
					include_once __DIR__ . "/../../assets/components/asidebar.php";
				?>
			</div>

			<div class="col-12 col-md-10">
				<div class="container py-2">

					<h1>Rooms</h1>

					<hr />

					<section class="dashboard-accounts py-5">
						<div class="container">
							<h4 class="mb-4 fw-bold">The Rooms Management</h4>
							<div class="table-responsive shadow rounded">
								<table class="table table-hover align-middle mb-3">
									<thead class="table-light">
										<tr class="text-center">
											<th scope="col">#</th>
											<th scope="col">Hotel Name</th>
											<th scope="col">Room Number</th>
											<th scope="col">Reserved</th>
											<th scope="col">Status</th>
											<th scope="col">View</th>
											<th scope="col">Cancel</th>
											<th scope="col">Remove/Delete</th>
											<th scope="col">Undo</th>
										</tr>
									</thead>
									<tbody>

										<?php
										$isn = ($currentPage - 1) * PAGINATION_LIMIT;
										foreach ($roomsModels as $room) {
											$isn++;
											$hotel = HotelRepository::get($room->hotel);
											$isFree = $room->reserved_by === null;
											$status = $room->status;

											$freeColor = "bg-success";
											$statusColor = "bg-success";
											$lockCancel = "disabled";
											$removeText = "Remove";
											$lockUndo = "disabled";

											if ($isFree) $isFree = "Free";
											else {
												$isFree = "Reserved";
												$freeColor = "bg-info";
												$lockCancel = "";
											}

											if ($status === ROOMS_STATUS_OK) $status = "OK";
											elseif ($status === ROOMS_STATUS_REMOVED) {
												$status = "REMOVED";
												$statusColor = "bg-danger";
												$removeText = "Delete";
												$lockUndo = "";
											}
										?>
										<tr class="text-center">
											<th scope="row"><?= $isn ?></th>
											<td><?= $hotel !== null ? $hotel->name : "(NULL)" ?></td>
											<td><span class="badge bg-dark">#<?= $room->number ?></span></td>
											<td><span class="badge <?= $freeColor ?>"><?= $isFree ?></span></td>
											<td><span class="badge <?= $statusColor ?>"><?= $status ?></span></td>
											<td><a href="<?= BASE_URL ?>reserve/?id=<?= $room->id ?>&mode=view" class="link-primary text-decoration-none">See</a></td>
											<td><a href="<?= BASE_URL ?>controllers/room.php?action=cancel&id=<?= $room->id ?>&redirect=<?= BASE_URL . "dashboard/rooms/?page=" . $currentPage ?>" class="btn btn-sm btn-danger text-decoration-none <?= $lockCancel ?>">Cancel</a></td>
											<td><a href="<?= BASE_URL ?>controllers/room.php?action=remove&id=<?= $room->id ?>&redirect=<?= BASE_URL . "dashboard/rooms/?page=" . $currentPage ?>" class="btn btn-sm btn-danger text-decoration-none"><?= $removeText ?></a></td>
											<td><a href="<?= BASE_URL ?>controllers/room.php?action=undo&id=<?= $room->id ?>&redirect=<?= BASE_URL . "dashboard/rooms/?page=" . $currentPage ?>" class="btn btn-sm btn-success text-decoration-none <?= $lockUndo ?>">Undo</a></td>
										</tr>
										<?php } ?>

									</tbody>
								</table>
							</div>

							<br />
							<br />

							<nav aria-label="Accounts pagination" class="d-flex justify-content-center">
								<?php
									$pageCount = RoomServices::getPageCount();
									$previous = $currentPage - 1;
									$next = $currentPage + 1;
									$previousLock = "";
									$nextLock = "";

									if ($previous <= 0)
										$previousLock = "disabled";
									if ($next - 1 >= $pageCount)
										$nextLock = "disabled";
								?>

								<ul class="pagination pagination-rounded gap-2">
									<li class="page-item <?= $previousLock ?>">
										<a class="page-link" href="?page=<?= $previous ?>" tabindex="<?= $previous ?>">&laquo;</a>
									</li>

									<?php
										for ($page = 1; $page < $pageCount + 1; $page++) {
											$active = "";
											if ($page === $currentPage) $active = " active";
									?>
									<li class="page-item<?= $active ?>"><a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a></li>
									<?php } ?>

									<li class="page-item <?= $nextLock ?>">
										<a class="page-link" href="?page=<?= $next ?>" tabindex="<?= $next ?>">&raquo;</a>
									</li>
								</ul>
							</nav>
						</div>
					</section>

				</div>
			</div>

			<div class="col-12 p-0">
				<?php include_once __DIR__ . "/../../assets/components/footer.php"; ?>
			</div>
		</div>
	</div>

	<script src="../../assets/libs/bootstrap.bundle.min.js"></script>
</body>
</html>
