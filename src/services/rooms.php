<?php

include_once __DIR__ . "/service.php";
include_once __DIR__ . "/../repositories/rooms.php";
include_once __DIR__ . "/../config.php";

class RoomServices extends Service {
	public static function getPageCount(
		int|null $bed = null,
		int|null $capacity = null,
		bool|null $onlyReserved = null
	): int {
		$recordCount = RoomRepository::getAllCount(
			$bed,
			$capacity,
			$onlyReserved
		);
		if ($recordCount < PAGINATION_LIMIT)
			return 1;
		return (int)ceil($recordCount / PAGINATION_LIMIT);
	}
}

?>
