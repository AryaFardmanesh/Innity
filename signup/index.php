<?php

session_start();

include_once __DIR__ . "/../src/services/accounts.php";
include_once __DIR__ . "/../src/utils/inputcheck.php";
include_once __DIR__ . "/../src/config.php";

AccountServices::redirectIfIsLogin(BASE_URL);

$formError = "";
$usernameError = "";
$passwordError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$role = $username = $password = "";

	if (isset($_POST["role"])) $role = inputcheck($_POST["role"]);

	if (isset($_POST["username"])) $username = inputcheck($_POST["username"]);
	else $usernameError = "The username field is not set.";

	if (isset($_POST["password"])) inputcheck($password = $_POST["password"]);
	else $passwordError = "The password field is not set.";

	if (AccountServices::signup($username, $password, $role) === false) {
		$formError = AccountServices::getError();
	}else {
		header("location:" . BASE_URL);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="../assets/images/logo/logo.png" type="image/x-icon" />
	<link href="../assets/libs/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/login.css" rel="stylesheet" />
	<title>Innity - Sign Up</title>
</head>
<body>
	<div class="login-box">
		<div class="mb-4 d-flex justify-content-center">
			<span class="h3">Sign Up</span>
		</div>

		<div class="mb-2">
			<span>Are you a traveller or hotel owner?</span>
		</div>

		<div class="mb-4 role-toggle d-flex">
			<button id="travellerBtn" class="btn btn-sm btn-primary w-50 active">Traveller</button>
			<button id="managerBtn" class="btn btn-sm btn-outline-primary w-50">Manager</button>
		</div>

		<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" autocomplete="off">
			<input type="hidden" id="roleInput" name="role" value="traveller" />

			<div class="mb-2">
				<label for="username" class="form-label">Username:</label>
				<input type="text" class="form-control form-control-sm" name="username" id="username" min="4" max="64" required />
				<small class="text-danger"><?= $usernameError ?></small>
			</div>

			<div class="mb-2">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control form-control-sm" name="password" id="password" min="4" max="64" required />
				<small class="text-danger"><?= $passwordError ?></small>
			</div>

			<small class="d-block text-center text-danger mb-2"><?= $formError ?></small>

			<button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Sign Up</button>
		</form>

		<span style="font-size: 14px;" class="d-block text-center mt-3">
			Do you have already an account? <a href="../login/">Just login</a>.
		</span>
	</div>

	<script src="../assets/libs/bootstrap.bundle.min.js"></script>

	<script>
	const travellerBtn = document.getElementById('travellerBtn');
	const managerBtn = document.getElementById('managerBtn');
	const roleInput = document.getElementById('roleInput');

	travellerBtn.addEventListener('click', () => {
		travellerBtn.classList.add('active', 'btn-primary');
		travellerBtn.classList.remove('btn-outline-primary');
		managerBtn.classList.remove('active', 'btn-primary');
		managerBtn.classList.add('btn-outline-primary');
		roleInput.value = "traveller";
	});

	managerBtn.addEventListener('click', () => {
		managerBtn.classList.add('active', 'btn-primary');
		managerBtn.classList.remove('btn-outline-primary');
		travellerBtn.classList.remove('active', 'btn-primary');
		travellerBtn.classList.add('btn-outline-primary');
		roleInput.value = "manager";
	});
	</script>
</body>
</html>
