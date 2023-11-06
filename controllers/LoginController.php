<?php
include 'DAO/LoginDAO.php';
if (!isset($_SESSION)) {
    session_start();
}
class LoginController
{
    public function login()
    {
        if (isset($_POST['signin'])) {

            $LoginDAO = new LoginDAO();
            $userInfo = $LoginDAO->login($_POST['username'], $_POST['password']);

            if ($userInfo) {
                // Lấy vai trò (role) từ dữ liệu người dùng
                $role = $userInfo[0]['role'];
                $id_u = $userInfo[0]['id_u'];
                $username = $userInfo[0]['tai_khoan'];
                // echo $_SESSION['acc'];
                // Thiết lập cookie cho vai trò (role)

                // Chuyển hướng sau khi đăng nhập thành công
                header("Location: index.php?controller=home");
                exit();
            } else {
                // Đăng nhập thất bại, xử lý lỗi ở đây (ví dụ: thông báo lỗi)
                echo "Đăng nhập thất bại.";
            }
        } else {

            include('views/login/login.php');
        }
    }
    public function loginAPI()
    {
    }
    public function logout()
    {
    }
    public function signup()
    {
        if (isset($_SESSION['username'])) {
            include('views/login/signup.php');
            // echo $_SESSION['username'];
        } else {
            if (isset($_POST['signup'])) {
                $trang_thai = 1;
                $LoginDAO = new LoginDAO();
                //echo $_SESSION['username'];
                $LoginDAO->signup($_POST['email'], $_POST['tai_khoan'], $_POST['password'], $_POST['role'], $trang_thai);
                include('views/login/login.php');
                exit();
            } else {
                include('views/login/signup.php');
            }
        }
    }
}
