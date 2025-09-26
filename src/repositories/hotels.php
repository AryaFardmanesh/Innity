<?php

include_once __DIR__ . "/repository.php";
include_once __DIR__ . "/../config.php";
include_once __DIR__ . "/../models/hotels.php";
include_once __DIR__ . "/../utils/database.php";

class HotelRepository extends Repository {
	public static function create(
		string $owner,
		string $image,
		string $name,
		string $description,
		string $country,
		string $city,
		int $stars
	): HotelModel|null {
		$hotel = new HotelModel(
			$owner,
			$image,
			$name,
			$description,
			$country,
			$city,
			$stars
		);
		$modelErr = $hotel->getError();
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

		$id = $hotel->id;
		$owner = $hotel->owner;
		$image = $hotel->image;
		$name = $hotel->name;
		$description = $hotel->description;
		$country = $hotel->country;
		$city = $hotel->city;
		$stars = $hotel->stars;
		$status = $hotel->status;
		$created_at = $hotel->create_at;

		if ($created_at === null) {
			$created_at = "CURRENT_TIMESTAMP";
		}

		$result = $db->execute(
			"INSERT INTO `hotels` (
				`id`,
				`owner`,
				`image`,
				`name`,
				`description`,
				`country`,
				`city`,
				`stars`,
				`status`,
				`created_at`
			) VALUES (
				'$id',
				'$owner',
				'$image',
				'$name',
				'$description',
				'$country',
				'$city',
				$stars,
				$status,
				$created_at
			);"
		);

		$db->disconnect();

		if ($result !== TRUE) {
			parent::setError("Cannot add new record.");
			return null;
		}

		return $hotel;
	}

	public static function remove(string $id): bool {
		/*
			For remove a hotel:
			  1. Select the hotel
			  2. Change the status to removed
			  3. If status is already setet as removed, now delete the record
		*/

		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return false;
		}

		$result = $db->execute(
			"SELECT `status` FROM `hotels`
			WHERE `hotels`.`id` = '$id';"
		);

		if (mysqli_num_rows($result) == 0) {
			parent::setError("This id is not exists in database.");
			$db->disconnect();
			return false;
		}

		$row = mysqli_fetch_assoc($result);

		if ((int)$row["status"] === HOTEL_STATUS_OK) {
			$removedStatus = HOTEL_STATUS_REMOVED;
			$result = $db->execute(
				"UPDATE `hotels`
				SET
					`status` = $removedStatus
				WHERE `hotels`.`id` = '$id';"
			);

			$db->disconnect();
			return ($result === TRUE) ? true : false;
		}else {
			$result = $db->execute(
				"DELETE FROM `hotels` WHERE `hotels`.`id` = '$id';"
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

		$okStatus = HOTEL_STATUS_OK;
		$result = $db->execute(
			"UPDATE `hotels`
			SET
				`status` = $okStatus
			WHERE `hotels`.`id` = '$id';"
		);

		$db->disconnect();
		return ($result === TRUE) ? true : false;
	}

	public static function update(HotelModel $model): bool {
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
		$image = $model->image;
		$name = $model->name;
		$description = $model->description;
		$country = $model->country;
		$city = $model->city;
		$stars = $model->stars;
		$status = $model->status;

		$result = $db->execute(
			"UPDATE `hotels`
			SET
				`image` = '$image',
				`name` = '$name',
				`description` = '$description',
				`country` = '$country',
				`city` = '$city',
				`stars` = '$stars',
				`status` = '$status'
			WHERE `hotels`.`id` = '$id';"
		);

		$db->disconnect();
		return ($result === TRUE) ? true : false;
	}

	public static function get(string $id): HotelModel|null {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `hotels` WHERE `hotels`.`id` = '$id';"
		);

		if (mysqli_num_rows($result) == 0) {
			parent::setError("This id is not exists in database.");
			$db->disconnect();
			return null;
		}

		$row = mysqli_fetch_assoc($result);
		$db->disconnect();

		$model = new HotelModel(
			$row["owner"],
			$row["image"],
			$row["name"],
			$row["description"],
			$row["country"],
			$row["city"],
			(int)($row["stars"]),
			(int)($row["status"])
		);
		$model->id = $row["id"];
		$model->create_at = new DateTimeImmutable($row["created_at"]);

		return $model;
	}

	public static function getForOwner(string $ownerId): array {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `hotels`
			WHERE `hotels`.`owner` = '$ownerId'
			ORDER BY `hotels`.`created_at` DESC;"
		);

		if (mysqli_num_rows($result) == 0) {
			return [];
		}

		$hotels = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$model = new HotelModel(
				$row["owner"],
				$row["image"],
				$row["name"],
				$row["description"],
				$row["country"],
				$row["city"],
				(int)($row["stars"]),
				(int)($row["status"])
			);
			$model->id = $row["id"];
			$model->create_at = new DateTimeImmutable($row["created_at"]);

			array_push($hotels, $model);
		}

		$db->disconnect();

		return $hotels;
	}

	public static function getAll(
		int $page = 1,
		int $limit = PAGINATION_LIMIT,
		string|null $name = null,
		int|null $stars = null,
		string|null $country = null,
		string|null $city = null
	): array {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$SQL_CONDITIONS = [];
		if ($name !== null) {
			array_push($SQL_CONDITIONS, "`hotels`.`name` LIKE '$name'");
		}
		if ($stars !== null) {
			array_push($SQL_CONDITIONS, "`hotels`.`stars` = '$stars'");
		}
		if ($country !== null) {
			array_push($SQL_CONDITIONS, "`hotels`.`country` LIKE '$country'");
		}
		if ($city !== null) {
			array_push($SQL_CONDITIONS, "`hotels`.`city` LIKE '$city'");
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
			"SELECT * FROM `hotels`"
			. $SQL_CONDITION .
			"ORDER BY `created_at`
			LIMIT $limit OFFSET $offset;"
		);

		if (mysqli_num_rows($result) == 0) {
			return [];
		}

		$hotels = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$model = new HotelModel(
				$row["owner"],
				$row["image"],
				$row["name"],
				$row["description"],
				$row["country"],
				$row["city"],
				(int)($row["stars"]),
				(int)($row["status"])
			);
			$model->id = $row["id"];
			$model->create_at = new DateTimeImmutable($row["created_at"]);

			array_push($hotels, $model);
		}

		$db->disconnect();

		return $hotels;
	}

	public static function getAllCount(
		string|null $name = null,
		int|null $stars = null,
		string|null $country = null,
		string|null $city = null
	): int {
		$db = new Database();

		if (!$db->connect()) {
			parent::setError("Cannot connect to the database.");
			return null;
		}

		$SQL_CONDITIONS = [];
		if ($name !== null) {
			array_push($SQL_CONDITIONS, "`hotels`.`name` LIKE '$name'");
		}
		if ($stars !== null) {
			array_push($SQL_CONDITIONS, "`hotels`.`stars` = '$stars'");
		}
		if ($country !== null) {
			array_push($SQL_CONDITIONS, "`hotels`.`country` LIKE '$country'");
		}
		if ($city !== null) {
			array_push($SQL_CONDITIONS, "`hotels`.`city` LIKE '$city'");
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
			"SELECT COUNT(*) AS total FROM `hotels` $SQL_CONDITION;"
		);

		$db->disconnect();

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return (int)$row["total"];
		}else {
			return 0;
		}
	}
}

?>
