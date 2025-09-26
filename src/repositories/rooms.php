<?php

include_once __DIR__ . "/repository.php";
include_once __DIR__ . "/../config.php";
include_once __DIR__ . "/../models/rooms.php";
include_once __DIR__ . "/../utils/database.php";

class RoomRepository extends Repository {
	public static function create(
		string $hotelId,
		string $image,
		string $description,
		int $price,
		int $number,
		int $bed,
		int $capacity
	): RoomModel|null {
		$room = new RoomModel(
			$hotelId,
			null,
			null,
			null,
			$image,
			$description,
			$price,
			$number,
			$bed,
			$capacity
		);
		$modelErr = $room->getError();
		if ($modelErr !== null) {
			parent::setError($modelErr);
			return null;
		}
		unset($modelErr);

		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$id = $room->id;
		$hotel = $room->hotel;
		$reserved_by = $room->reserved_by;
		$reserved_time = $room->reserved_time;
		$reserved_for = $room->reserved_for;
		$image = $room->image;
		$description = $room->description;
		$price = $room->price;
		$number = $room->number;
		$bed = $room->bed;
		$capacity = $room->capacity;
		$status = $room->status;
		$created_at = $room->create_at;

		if ($reserved_by !== null) {
			$reserved_by = "'$reserved_by'";
		}else {
			$reserved_by = "NULL";
		}
		if ($reserved_time !== null) {
			$reserved_time = "'$reserved_time'";
		}else {
			$reserved_time = "NULL";
		}
		if ($reserved_for !== null) {
			$reserved_for = "'$reserved_for'";
		}else {
			$reserved_for = "NULL";
		}
		if ($created_at === null) {
			$created_at = "CURRENT_TIMESTAMP";
		}

		$result = $db->execute(
			"INSERT INTO `rooms` (
				`id`,
				`hotel`,
				`reserved_by`,
				`reserved_time`,
				`reserved_for`,
				`image`,
				`description`,
				`price`,
				`number`,
				`bed`,
				`capacity`,
				`status`,
				`created_at`
			) VALUE (
				'$id',
				'$hotel',
				$reserved_by,
				$reserved_time,
				$reserved_for,
				'$image',
				'$description',
				$price,
				$number,
				$bed,
				$capacity,
				$status,
				$created_at
			);"
		);

		$db->disconnect();

		if ($result !== TRUE) {
			parent::setError("Cannot add new record.");
			return null;
		}

		return $room;
	}

	public static function remove(string $id): bool {
		/*
			For remove a room:
			  1. Select the room
			  2. Change the status to removed
			  3. If status is already setet as removed, now delete the record
		*/

		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return false;
		}

		$result = $db->execute(
			"SELECT `status` FROM `rooms`
			WHERE `rooms`.`id` = '$id';"
		);

		if (mysqli_num_rows($result) == 0) {
			parent::setError("This id is not exists in database.");
			$db->disconnect();
			return false;
		}

		$row = mysqli_fetch_assoc($result);

		if ((int)$row["status"] === ROOMS_STATUS_OK) {
			$removedStatus = ROOMS_STATUS_REMOVED;
			$result = $db->execute(
				"UPDATE `rooms`
				SET
					`status` = $removedStatus
				WHERE `rooms`.`id` = '$id';"
			);

			$db->disconnect();
			return ($result === TRUE) ? true : false;
		}else {
			$result = $db->execute(
				"DELETE FROM `rooms` WHERE `rooms`.`id` = '$id';"
			);
			$db->disconnect();
			return ($result === TRUE) ? true : false;
		}
	}

	public static function undoRemove(string $id): bool {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return false;
		}

		$okStatus = ROOMS_STATUS_OK;
		$result = $db->execute(
			"UPDATE `rooms`
			SET
				`status` = $okStatus
			WHERE `rooms`.`id` = '$id';"
		);

		$db->disconnect();
		return ($result === TRUE) ? true : false;
	}

	public static function update(RoomModel $model): bool {
		$modelErr = $model->getError();
		if ($modelErr !== null) {
			parent::setError($modelErr);
			return false;
		}
		unset($modelErr);

		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return false;
		}

		$id = $model->id;
		$hotelId = $model->hotel;
		$reserved_by = $model->reserved_by;
		$reserved_time = $model->reserved_time;
		$reserved_for = $model->reserved_for;
		$image = $model->image;
		$description = $model->description;
		$price = $model->price;
		$number = $model->number;
		$bed = $model->bed;
		$capacity = $model->capacity;

		if ($reserved_by !== null) {
			$reserved_by = "'$reserved_by'";
		}else {
			$reserved_by = "NULL";
		}
		if ($reserved_time !== null) {
			$reserved_time = "'" . $reserved_time->format("Y-m-d H:i:s") . "'";
		}else {
			$reserved_time = "NULL";
		}
		if ($reserved_for !== null) {
			$reserved_for = "'$reserved_for'";
		}else {
			$reserved_for = "NULL";
		}

		$result = $db->execute(
			"UPDATE `rooms`
			SET
				`hotel` = '$hotelId',
				`reserved_by` = $reserved_by,
				`reserved_time` = $reserved_time,
				`reserved_for` = $reserved_for,
				`image` = '$image',
				`description` = '$description',
				`price` = $price,
				`number` = $number,
				`bed` = $bed,
				`capacity` = $capacity
			WHERE `rooms`.`id` = '$id';"
		);

		$db->disconnect();
		return ($result === TRUE) ? true : false;
	}

	public static function get(string $id): RoomModel|null {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `rooms` WHERE `rooms`.`id` = '$id';"
		);

		if (mysqli_num_rows($result) == 0) {
			parent::setError("This id is not exists in database.");
			$db->disconnect();
			return null;
		}

		$row = mysqli_fetch_assoc($result);
		$db->disconnect();

		$reserved_time = $row["reserved_time"];
		$reserved_for = $row["reserved_for"];

		if ($reserved_time !== null) $reserved_time = new DateTimeImmutable($reserved_time);
		if ($reserved_for !== null) $reserved_for = (int)$reserved_for;

		$model = new RoomModel(
			$row["hotel"],
			$row["reserved_by"],
			$reserved_time,
			$reserved_for,
			$row["image"],
			$row["description"],
			(int)$row["price"],
			(int)$row["number"],
			(int)$row["bed"],
			(int)$row["capacity"],
			(int)($row["status"])
		);
		$model->id = $row["id"];
		$model->create_at = new DateTimeImmutable($row["created_at"]);

		return $model;
	}

	public static function getForHotel(string $hotelId): array {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `rooms`
			WHERE `rooms`.`hotel` = '$hotelId'
			ORDER BY `rooms`.`created_at` DESC;"
		);

		if (mysqli_num_rows($result) == 0) {
			return [];
		}

		$rooms = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$reserved_time = $row["reserved_time"];
			$reserved_for = $row["reserved_for"];

			if ($reserved_time !== null) $reserved_time = new DateTimeImmutable($reserved_time);
			if ($reserved_for !== null) $reserved_for = (int)$reserved_for;

			$model = new RoomModel(
				$row["hotel"],
				$row["reserved_by"],
				$reserved_time,
				$reserved_for,
				$row["image"],
				$row["description"],
				(int)$row["price"],
				(int)$row["number"],
				(int)$row["bed"],
				(int)$row["capacity"],
				(int)($row["status"])
			);
			$model->id = $row["id"];
			$model->create_at = new DateTimeImmutable($row["created_at"]);

			array_push($rooms, $model);
		}

		$db->disconnect();

		return $rooms;
	}

	public static function getReservedRoomsForUser(string $userId): array {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `rooms`
			WHERE `rooms`.`reserved_by` = '$userId'
			ORDER BY `rooms`.`created_at` DESC;"
		);

		if (mysqli_num_rows($result) == 0) {
			return [];
		}

		$rooms = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$reserved_time = $row["reserved_time"];
			$reserved_for = $row["reserved_for"];

			if ($reserved_time !== null) $reserved_time = new DateTimeImmutable($reserved_time);
			if ($reserved_for !== null) $reserved_for = (int)$reserved_for;

			$model = new RoomModel(
				$row["hotel"],
				$row["reserved_by"],
				$reserved_time,
				$reserved_for,
				$row["image"],
				$row["description"],
				(int)$row["price"],
				(int)$row["number"],
				(int)$row["bed"],
				(int)$row["capacity"],
				(int)($row["status"])
			);
			$model->id = $row["id"];
			$model->create_at = new DateTimeImmutable($row["created_at"]);

			array_push($rooms, $model);
		}

		$db->disconnect();

		return $rooms;
	}

	public static function getAll(
		int $page = 1,
		int $limit = PAGINATION_LIMIT,
		int|null $bed = null,
		int|null $capacity = null,
		bool|null $onlyReserved = null
	): array {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$SQL_CONDITIONS = [];
		if ($bed !== null) {
			array_push($SQL_CONDITIONS, "`rooms`.`bed` = '$bed'");
		}
		if ($capacity !== null) {
			array_push($SQL_CONDITIONS, "`rooms`.`capacity` = '$capacity'");
		}
		if ($onlyReserved !== null) {
			if ($onlyReserved) {
				array_push($SQL_CONDITIONS, "`rooms`.`reserved_by` IS NOT NULL");
			}else {
				array_push($SQL_CONDITIONS, "`rooms`.`reserved_by` IS NULL");
			}
		}

		$SQL_CONDITION = "";
		$SQL_CONDITIONS_COUNT = count($SQL_CONDITIONS);
		if ($SQL_CONDITIONS_COUNT) {
			$SQL_CONDITION .= " WHERE ";
		}
		for ($i = 0; $i < $SQL_CONDITIONS_COUNT; $i++) {
			$SQL_CONDITION .= $SQL_CONDITIONS[$i];

			if ($i + 1 < $SQL_CONDITIONS_COUNT) {
				$SQL_CONDITION .= " AND ";
			}
		}

		$offset = ($page - 1) * $limit;
		$result = $db->execute(
			"SELECT * FROM `rooms`"
			. $SQL_CONDITION .
			" ORDER BY `created_at`
			LIMIT $limit OFFSET $offset;"
		);

		if (mysqli_num_rows($result) == 0) {
			return [];
		}

		$rooms = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$reserved_time = $row["reserved_time"];
			$reserved_for = $row["reserved_for"];

			if ($reserved_time !== null) $reserved_time = new DateTimeImmutable($reserved_time);
			if ($reserved_for !== null) $reserved_for = (int)$reserved_for;

			$model = new RoomModel(
				$row["hotel"],
				$row["reserved_by"],
				$reserved_time,
				$reserved_for,
				$row["image"],
				$row["description"],
				(int)$row["price"],
				(int)$row["number"],
				(int)$row["bed"],
				(int)$row["capacity"],
				(int)($row["status"])
			);
			$model->id = $row["id"];
			$model->create_at = new DateTimeImmutable($row["created_at"]);

			array_push($rooms, $model);
		}

		$db->disconnect();

		return $rooms;
	}

	public static function getAllCount(
		int|null $bed = null,
		int|null $capacity = null,
		bool|null $onlyReserved = null
	): int {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$SQL_CONDITIONS = [];
		if ($bed !== null) {
			array_push($SQL_CONDITIONS, "`rooms`.`bed` = $bed");
		}
		if ($capacity !== null) {
			array_push($SQL_CONDITIONS, "`rooms`.`capacity` = $capacity");
		}
		if ($onlyReserved !== null) {
			if ($onlyReserved) {
				array_push($SQL_CONDITIONS, "`rooms`.`reserved_by` IS NOT NULL");
			}else {
				array_push($SQL_CONDITIONS, "`rooms`.`reserved_by` IS NULL");
			}
		}

		$SQL_CONDITION = "";
		$SQL_CONDITIONS_COUNT = count($SQL_CONDITIONS);
		if ($SQL_CONDITIONS_COUNT) {
			$SQL_CONDITION .= " WHERE ";
		}
		for ($i = 0; $i < $SQL_CONDITIONS_COUNT; $i++) {
			$SQL_CONDITION .= $SQL_CONDITIONS[$i];

			if ($i + 1 < $SQL_CONDITIONS_COUNT) {
				$SQL_CONDITION .= " AND ";
			}
		}

		$result = $db->execute(
			"SELECT COUNT(*) AS total FROM `rooms` $SQL_CONDITION;"
		);

		if (mysqli_num_rows($result)) {
			$row = $result->fetch_assoc();
			return (int)$row["total"];
		}else {
			return 0;
		}
	}
}

?>
