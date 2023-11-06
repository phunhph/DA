<?php
session_start();
include 'controllers/LoginController.php';
include 'controllers/HomeController.php';
$controller = $_GET['controller'] ?? 'home';
switch ($controller) {
    case 'home':
        $HomeController = new HomeController();
        $HomeController->index();
        break;
    case 'login':
        $LoginController = new LoginController();
        $LoginController->login();
        break;
    case 'logout':
        break;
    case 'signup':
        $LoginController = new LoginController();

        $LoginController->signup();
        break;
    case 'nhaphathanh':
        break;
    case 'nhasanxuat':
        break;
    case 'bo':
        break;
    case 'loaisanpham':
        break;
    case 'sanpham':
        break;
    case 'chat':
        $HomeController = new HomeController();
        $HomeController->indexChat();
        break;
    case 'binhluan':
        break;
    case 'thongbao':
        break;
    case 'theodoi':
        break;
    case 'giohang':
        break;
    case 'donhang':
        break;
}
