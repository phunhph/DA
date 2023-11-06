<?php
include 'models/login.php';
class LoginDAO
{
    private $PDO;
    public function __construct()
    {
        require('config/config.php');
        $this->PDO = $pdo;
    }
    function login($username, $password)
    {
        $sql = "SELECT id_quyen,id_user,tai_khoan,trang_thai FROM `users` WHERE tai_khoan='$username' and mat_khau='$password'";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();

        $data = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Create an associative array with 'id_u' and 'role' keys
            $_SESSION['role'] = $row['id_quyen'];
            $_SESSION['acc'] =  $row['id_user'];
            $_SESSION['user'] = $row['tai_khoan'];
            $userData = array(
                'id_u' => $row['id_user'],
                'role' => $row['id_quyen'],
                'tai_khoan' => $row['tai_khoan'],
                'trang_thai' => $row['trang_thai'],
            );

            // Add the user data to the data array
            $data[] = $userData;
        }

        return $data; // Return an array containing 'id_u' and 'role'
    }
    function signup($email, $username, $password,  $role, $trang_thai)
    {
        $sql = "INSERT INTO `users`( `email`,`tai_khoan`,`mat_khau`, `id_quyen`, `trang_thai`) VALUES ('$email','$username','$password',$role,$trang_thai)";
        $stmt = $this->PDO->prepare($sql);
        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        }
    }
}
