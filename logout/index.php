<?php

include_once __DIR__ . "/../src/config.php";

session_start();
session_regenerate_id(true);
session_destroy();
header("location:" . BASE_URL);

?>
