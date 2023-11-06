<?php

include_once "../controllers/ChatBoxController.php";
$users = new ChatBoxController();

$users->getusers();
