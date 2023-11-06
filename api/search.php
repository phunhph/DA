<?php

include_once "../controllers/ChatBoxController.php";
$users = new ChatBoxController();

$searchTerm = $_POST['searchTerm'];

$users->Search($searchTerm);
