<?php
include_once 'app/models/CatatanModel.php';
include_once 'app/models/KategoriModel.php';
include_once 'config/db_config.php';

class CatatanController {
    private $CatatanModel;
    private $KategoriModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->CatatanModel = new CatatanModel($this->db);
        $this->KategoriModel = new KategoriModel($this->db);
    }

    public function index() {
        if(!isset($_SESSION['admin_id'])) {
            header('Location: index.php');
            exit;
        }

        $data_catatan = $this->CatatanModel->getAll();

        include 'app/view/catatan/index.php';
    }

    public function tambah() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        $data_kategori = $this->KategoriModel->getAll();
        include 'app/view/catatan/tambah.php';
    }

    public function tambahProses() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }

        if ($_POST) {
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $kategori_id = $_POST['kategori_id'];
            $admin_id = $_SESSION['admin_id'];

            if (!empty($judul)) {
                $this->CatatanModel->create($judul, $isi, $kategori_id, $admin_id);
                $_SESSION['success_msg'] = "Berhasil Tambah Catatan!";
            }
        }
        header("Location: index.php?act=catatan");
        exit;
    }

    public function edit() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }

        $id = isset($_GET['id']) ? $_GET['id'] : die('Error: id kosong');
        $catatan = $this->CatatanModel->getById($id);
        $data_kategori = $this->KategoriModel->getAll();
        include 'app/view/catatan/edit.php';
    }

    public function editProses() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }

        if ($_POST) {
            $id = $_POST['id'];
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $kategori_id = $_POST['kategori_id'];

            if (!empty($judul) && !empty($id)) {
                $this->CatatanModel->update($id, $judul, $isi, $kategori_id);
                $_SESSION['success_msg'] = "Berhasil Edit Catatan";
            }
        }
        header("Location: index.php?act=catatan");
    }

    public function hapus() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }

        if (isset($_GET['id'])) {
            $this->CatatanModel->delete($_GET['id']);
            $_SESSION['success_msg'] = "Berhasil Hapus Catatan";
        }
        header("Location: index.php?act=catatan");
        exit;
    }
}
?>