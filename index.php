<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="./assets/images/logo/logo.png" type="image/x-icon" />
	<link href="./assets/libs/bootstrap.min.css" rel="stylesheet" />
	<link href="./assets/css/navbar.css" rel="stylesheet" />
	<title>Innity - Home</title>
	<style>
		.carousel-item img {
			height: 550px;
			object-fit: cover;
			filter: brightness(0.7);
		}

		.carousel-caption {
			bottom: 50%;
			transform: translateY(50%);
		}

		.carousel-caption h2 {
			font-size: 2.5rem;
			font-weight: bold;
			color: #fff;
			text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
		}
	</style>
</head>
<body>
	<?php include_once __DIR__ . "/assets/components/navbar.php"; ?>

	<div id="homeCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
			<button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
			<button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
			<button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
		</div>

		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="./assets/images/header/header-1.jpg" class="d-block w-100" alt="Header 1">
				<div class="carousel-caption">
					<h2>Discover Comfort in Every Stay</h2>
				</div>
			</div>

			<div class="carousel-item">
				<img src="./assets/images/header/header-2.jpg" class="d-block w-100" alt="Header 2">
				<div class="carousel-caption">
					<h2>Your Journey Begins with Us</h2>
				</div>
			</div>

			<div class="carousel-item">
				<img src="./assets/images/header/header-3.jpg" class="d-block w-100" alt="Header 3">
				<div class="carousel-caption">
					<h2>Feel at Home, Anywhere</h2>
				</div>
			</div>

			<div class="carousel-item">
				<img src="./assets/images/header/header-4.jpg" class="d-block w-100" alt="Header 4">
				<div class="carousel-caption">
					<h2>Book Moments, Not Just Rooms</h2>
				</div>
			</div>

			<div class="carousel-item">
				<img src="./assets/images/header/header-5.jpg" class="d-block w-100" alt="Header 5">
				<div class="carousel-caption">
					<h2>Hotels That Match Your Dreams</h2>
				</div>
			</div>

			<div class="carousel-item">
				<img src="./assets/images/header/header-6.jpg" class="d-block w-100" alt="Header 6">
				<div class="carousel-caption">
					<h2>Experience Innity – Where Travel Meets Comfort</h2>
				</div>
			</div>
		</div>

		<button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>

		<button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>

	<section class="py-5 text-center" id="intro">
		<div class="container">
			<h1 class="h2 mb-4">What is Innity?</h1>
			<p class="lead mx-auto" style="max-width: 800px;">
				<strong>Innity</strong> is a modern hotel booking platform designed to connect travelers with the best hotels across the globe. Whether you're looking for a luxury suite or a budget-friendly stay, Innity helps you find, compare, and reserve the perfect room in just a few clicks. 
				With secure bookings, trusted hotel managers, and a user-friendly interface, Innity makes your travel experience easier, faster, and more reliable than ever before.
			</p>
		</div>
	</section>

	<section class="py-5 bg-light">
		<div class="container">
			<h2 class="text-center mb-4">Why Choose Innity?</h2>

			<div class="row g-4">

				<div class="col-md-6 col-lg-3">
					<div class="card h-100 text-center shadow-sm border-0">
						<div class="card-body">
							<h5 class="card-title">Secure Booking</h5>
							<p class="card-text">Your data and payments are protected with the latest security technologies.</p>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card h-100 text-center shadow-sm border-0">
						<div class="card-body">
							<h5 class="card-title">Top-Rated Hotels</h5>
							<p class="card-text">We offer a carefully selected list of the best hotels around the world.</p>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card h-100 text-center shadow-sm border-0">
						<div class="card-body">
							<h5 class="card-title">24/7 Support</h5>
							<p class="card-text">Our team is available day and night to help you with your questions and needs.</p>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card h-100 text-center shadow-sm border-0">
						<div class="card-body">
							<h5 class="card-title">Customer Satisfaction</h5>
							<p class="card-text">We value your feedback and are committed to resolving your complaints.</p>
						</div>
					</div>
				</div>

			</div>

		</div>
	</section>

	<section class="py-5 bg-white" id="about">
		<div class="container">
			<h2 class="text-center mb-4">About Us</h2>
			<div class="row align-items-center">
				<div class="col-md-6 mb-3 mb-md-0">
					<img src="./assets/images/etc/about.jpg" alt="About Us" class="img-fluid rounded shadow-sm">
				</div>
				<div class="col-md-6">
					<p class="lead">
						At <strong>Innity</strong>, we believe that booking a hotel should be simple, secure, and reliable. Our platform connects travelers with top-rated hotels around the world, offering the best services at affordable prices.
					</p>
					<p>
						Whether you're traveling for business or leisure, Innity ensures you get the best stay experience with easy reservation, trusted reviews, and 24/7 support. We are committed to making your journey stress-free and memorable.
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="py-5 bg-light" id="contact">
		<div class="container">
			<h2 class="text-center mb-4">Contact Us</h2>
			<div class="row">
				<div class="col-md-6 d-flex flex-column justify-content-center order-last order-md-first">
					<h5>Contact Information</h5>
					<p><strong>Email:</strong> support@innity.com</p>
					<p><strong>Phone:</strong> +1 234 567 890</p>
					<p><strong>Address:</strong> 123 Innity Street, Travel City, World</p>
					<div class="mt-4">
						<h6>Follow Us:</h6>
						<a href="#" class="me-2"><i class="bi bi-facebook"></i> Facebook</a>
						<a href="#" class="me-2"><i class="bi bi-twitter"></i> Twitter</a>
						<a href="#"><i class="bi bi-instagram"></i> Instagram</a>
					</div>
				</div>
				<div class="col-md-6 mb-3 mb-md-0 order-first order-md-last">
					<img src="./assets/images/etc/contact.jpg" alt="Contact Us" class="img-fluid rounded shadow-sm">
				</div>
			</div>
		</div>
	</section>

	<?php include_once __DIR__ . "/assets/components/footer.php"; ?>

	<script src="./assets/libs/bootstrap.bundle.min.js"></script>
</body>
</html>
