<?php

include_once __DIR__ . "/../../src/services/accounts.php";
include_once __DIR__ . "/../../src/config.php";

?>

<nav class="navbar navbar-expand-lg navbar-light bg-white navbar-custom">
	<div class="container">
		<a class="navbar-brand" href="<?= BASE_URL ?>">Innity</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="<?= BASE_URL ?>">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= BASE_URL ?>hotels/">Hotels</a>
				</li>
				<?php if (AccountServices::isLogin()) { ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= BASE_URL ?>profile/">Profile</a>
				</li>
				<?php } ?>
			</ul>

			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<?php if (!AccountServices::isLogin()) { ?>

				<li class="nav-item">
					<a class="nav-link btn btn-outline-primary me-2 right-custom-link" href="<?= BASE_URL ?>login/">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link btn btn-primary right-custom-link" href="<?= BASE_URL ?>signup/">Sign Up</a>
				</li>

				<?php } else { ?>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
						👤 <?= "Welcome" ?>
					</a>
					<ul class="dropdown-menu dropdown-menu-end">
						<?php if (AccountServices::isLoginAsManager()) { ?>
						<li><a class="dropdown-item" href="<?= BASE_URL ?>management/">Management</a></li>
						<li><hr class="dropdown-divider"></li>
						<?php } elseif (AccountServices::isLoginAsAdmin()) { ?>
						<li><a class="dropdown-item" href="<?= BASE_URL ?>management/">Management</a></li>
						<li><a class="dropdown-item" href="<?= BASE_URL ?>dashboard/">Panel</a></li>
						<li><hr class="dropdown-divider"></li>
						<?php } ?>
						<li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>logout/">Logout</a></li>
					</ul>
				</li>

				<?php } ?>
			</ul>
	</div>
	</div>
</nav>
