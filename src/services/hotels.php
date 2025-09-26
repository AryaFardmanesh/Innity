<?php

include_once __DIR__ . "/service.php";
include_once __DIR__ . "/../repositories/hotels.php";
include_once __DIR__ . "/../config.php";

class HotelsServices extends Service {
	public static function getPageCount(
		string|null $name = null,
		int|null $stars = null,
		string|null $country = null,
		string|null $city = null
	): int {
		$recordCount = HotelRepository::getAllCount(
			$name,
			$stars,
			$country,
			$city
		);
		if ($recordCount < PAGINATION_LIMIT)
			return 1;
		return (int)ceil($recordCount / PAGINATION_LIMIT);
	}
}

?>
