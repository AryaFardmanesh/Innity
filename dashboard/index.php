<?php include_once __DIR__ . "/back.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/x-icon" />
	<link href="../assets/libs/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/navbar.css" rel="stylesheet" />
	<link href="../assets/css/asidebar.css" rel="stylesheet" />
	<title>Innity - Dashboard</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 p-0">
				<?php include_once __DIR__ . "/../assets/components/navbar.php"; ?>
			</div>

			<div class="col-12 col-md-2 p-0">
				<?php
					$AsideBarSetting_ActiveLink = "dashboard";
					include_once __DIR__ . "/../assets/components/asidebar.php";
				?>
			</div>

			<div class="col-12 col-md-10">
				<div class="container py-2">

					<h1>Dashboard</h1>

					<hr />

					<h2 class="mb-4">Welcome to Innity</h2>
					<p class="lead mb-4">
						Innity is a comprehensive online hotel reservation platform designed to simplify your travel planning experience. Whether you are a traveler seeking the best accommodations or a hotel manager looking to showcase your property, Innity provides a seamless and user-friendly interface.
					</p>

					<h2 class="mb-3">Project Overview</h2>
					<p class="mb-4">
						This project was developed as an educational tool to demonstrate full-stack web development skills. It features user roles including travelers, hotel managers, and administrators, each with tailored functionalities to meet their needs.
					</p>

					<h3 class="mb-3">Key Features</h3>
					<ul class="mb-4">
						<li>Browse and search hotels by location and rating.</li>
						<li>Manage hotel information and rooms for hotel owners.</li>
						<li>Secure reservation system with easy booking and cancellation.</li>
						<li>Administrative dashboard to oversee all accounts, hotels, rooms, and reservations.</li>
					</ul>

					<h4 class="mb-3">Purpose and Goals</h4>
					<p class="mb-4">
						The goal of Innity is to provide a scalable and efficient platform for hotel reservations, demonstrating best practices in web development including responsive design, database integration, and user authentication.
					</p>

					<h5 class="mb-3">About the Developer</h5>
					<p>
						Developed and maintained by <strong>Matin Alavikia</strong>, this project showcases dedication to clean code, usability, and modern web technologies.
					</p>

				</div>
			</div>

			<div class="col-12 p-0">
				<?php include_once __DIR__ . "/../assets/components/footer.php"; ?>
			</div>
		</div>
	</div>

	<script src="../assets/libs/bootstrap.bundle.min.js"></script>
</body>
</html>
