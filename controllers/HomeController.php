<?php
if (!isset($_SESSION)) {
    session_start();
}
class HomeController
{
    public function index()
    {
        if (isset($_SESSION['acc'])) {
            if (isset($_SESSION['role']) && $_SESSION['role'] == 4) {
                include('views/home/user/chatbox.php');
            } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 2) {
                include('views/home/admin/users.php');
            }
        } else {
            include('views/login/login.php');
        }
    }
    public function indexChat()
    {
        include('views/home/admin/chatbox.php');
    }
}
