<?php
    include_once 'config/db_config.php';
    include_once 'app/models/AdminModel.php';

    class AdminController {
        private $adminModel;
        private $db;

        public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->adminModel = new AdminModel($this->db);
        }

        //Untuk Menampilkan Halaman Register
        public function viewRegister() {
        include 'app/view/auth/register.php';
        }

        //Proses Register
        public function register() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password_pengguna = $_POST['password_pengguna'];

            if(strlen($password_pengguna) < 2){
            $error = "Password harus lebih dari 1 karakter!";
            include 'app/view/auth/login.php';
            return;
        }

            if($this->adminModel->register($username, $password_pengguna)) {
                    $success = "Registrasi Berhasil Silahkan Login";
                    header("Location: index.php?act=login");
                }else {
                    $error = "Gagal Mendaftar. Username Mungkin Sudah Dipakai";
                   header("Location: index.php?act=register");
                    exit;

                }
            }
        }

        //Menampilkan Halaman Login
        public function index()
        {
            if (isset($_SESSION['id_admin'])) {
                header("Location: index.php?act=dashboard");
                exit;
            }
            include 'app/view/auth/login.php';
        }

        public function login()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password_pengguna = $_POST['password_pengguna'];

        if(strlen($password_pengguna) < 2){
            $error = "Password harus lebih dari 1 karakter!";
            include 'app/view/auth/login.php';
            return;
        }

        $admin = $this->adminModel->login($username, $password_pengguna);

        if($admin) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            header("Location: index.php?act=dashboard");
        } else {
            $error ="Username atau Password Salah!";
            include 'app/view/auth/login.php';
        }
    }
}

        public function dashboard()
        {
            if(!isset($_SESSION['admin_id'])) {
                header("Location: index.php");
                exit;
            }
            include 'app/view/dashboard/index.php';
        }

        //Proses Logout
        public function logout()
        {
            session_destroy();
            header("Location: index.php");
        }

    }
?>