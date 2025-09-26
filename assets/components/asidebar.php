<?php

include_once __DIR__ . "/../../src/config.php";

$AsideBarSetting_NonActiveClass = "text-dark";
$AsideBarSetting_ActiveClass = "active";

$dashboardLinkClass = $AsideBarSetting_ActiveLink == "dashboard" ? $AsideBarSetting_ActiveClass : $AsideBarSetting_NonActiveClass;
$accountsLinkClass = $AsideBarSetting_ActiveLink == "accounts" ? $AsideBarSetting_ActiveClass : $AsideBarSetting_NonActiveClass;
$hotelsLinkClass = $AsideBarSetting_ActiveLink == "hotels" ? $AsideBarSetting_ActiveClass : $AsideBarSetting_NonActiveClass;
$roomsLinkClass = $AsideBarSetting_ActiveLink == "rooms" ? $AsideBarSetting_ActiveClass : $AsideBarSetting_NonActiveClass;
$reservationsLinkClass = $AsideBarSetting_ActiveLink == "reservations" ? $AsideBarSetting_ActiveClass : $AsideBarSetting_NonActiveClass;

?>

<nav id="admin-sidebar" class="d-flex flex-column bg-light shadow-sm px-1 py-2">
	<ul class="nav nav-pills flex-column">
		<li class="nav-item mb-1">
			<a href="<?= BASE_URL ?>dashboard/" class="nav-link w-100 <?= $dashboardLinkClass ?>">
				Dashboard
			</a>
		</li>
		<li class="nav-item mb-1">
			<a href="<?= BASE_URL ?>dashboard/accounts/" class="nav-link w-100 <?= $accountsLinkClass ?>">
				Accounts
			</a>
		</li>
		<li class="nav-item mb-1">
			<a href="<?= BASE_URL ?>dashboard/hotels/" class="nav-link w-100 <?= $hotelsLinkClass ?>">
				Hotels
			</a>
		</li>
		<li class="nav-item mb-1">
			<a href="<?= BASE_URL ?>dashboard/rooms/" class="nav-link w-100 <?= $roomsLinkClass ?>">
				Rooms
			</a>
		</li>
		<li class="nav-item mb-1">
			<a href="<?= BASE_URL ?>dashboard/reservations/" class="nav-link w-100 <?= $reservationsLinkClass ?>">
				Reservations
			</a>
		</li>
	</ul>
</nav>

<?php

unset($AsideBarSetting_ActiveLink);
unset($AsideBarSetting_NonActiveClass);
unset($AsideBarSetting_ActiveClass);
unset($dashboardLinkClass);
unset($accountsLinkClass);
unset($hotelsLinkClass);
unset($roomsLinkClass);
unset($reservationsLinkClass);

?>
