<?php
class Login
{
    public $tai_khoang;
    public $email;
    public $mat_khau;
    public function login($tai_khoang, $email, $mat_khau)
    {
        $this->tai_khoang = $tai_khoang;
        $this->email = $email;
        $this->mat_khau = $mat_khau;
    }
}
class role
{
    public $role;
    public function role($role)
    {
        $this->role = $role;
    }
}
