<?php
include_once 'config/db_config.php';
include_once 'app/models/KategoriModel.php';

class KategoriController
{
    private $db;
    private $kategoriModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->kategoriModel = new KategoriModel($this->db);
    }

    public function index()
    {
        if(!isset($_SESSION['admin_id'])) {
            header('Location: index.php');
            exit;
        }

        $data_kategori = $this->kategoriModel->getAll();

        include 'app/view/kategori/index.php';
    }

    public function tambah()
    {
        if(!isset($_SESSION['admin_id'])) {
            header('Location: index.php');
            exit;
        }

        include 'app/view/kategori/tambah.php';
    }

    public function tambahProses()
    {
        if(!isset($_SESSION['admin_id'])) {
            header('Location: index.php');
            exit;
        }

        if($_POST) {
            $nama = $_POST['nama_kategori'];
            $admin_id = $_SESSION['admin_id'];

            if(!empty($nama)) {
                if ($this->kategoriModel->cekKategoriAda($nama)) {
                    $_SESSION['error_msg'] = "Gagal: Kategori '<b>$nama</b>' Sudah Ada!";
                    header("Location: index.php?act=kategori-tambah");
                    exit;
                } else {
                    $this->kategoriModel->create($nama, $admin_id);
                    $_SESSION['success_msg'] = "Kategori '<b>$nama</b>' Berhasil Ditambahkan!";
                    header("Location: index.php?act=kategori");
                    exit;
                }
            }
        }
    }

    public function edit()
    {
        if(!isset($_SESSION['admin_id'])) {
            header('Location: index.php');
            exit;
        }

        $id = isset($_GET['id']) ? $_GET['id'] : die("Error: ID Kategori Tidak Ditemukan");

        $kategori = $this->kategoriModel->getById($id);

        include 'app/view/kategori/edit.php';

    }

   public function editproses()
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }

        if ($_POST) {
            $id = $_POST['id'];
            $nama_baru = $_POST['nama_kategori'];

            if (!empty($nama_baru) && !empty($id)) {

            $kategori_lama = $this->kategoriModel->getById($id);
            if ($nama_baru !== $kategori_lama['nama_kategori']) {

            if ($this->kategoriModel->cekKategoriAda($nama_baru)) {
                $_SESSION['error_msg'] = "Gagal Update: Kategori '<b>$nama_baru</b>' Sudah Digunakan!";
                header("Location: index.php?act=kategori-edit&id=" . $id);
                exit;
            }
            }

            $this->kategoriModel->update($id, $nama_baru);
            $_SESSION['success_msg'] = "Kategori Berhasil Diupdate!";
            } 
        }
        header("Location: index.php?act=kategori");
        exit;
    }

    public function hapus()
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }

        $id = isset($_GET['id']) ? $_GET['id'] : die("Error: ID Kategori Tidak Ditemukan");

        $this->kategoriModel->delete($id);
        $_SESSION['success_msg'] = "Kategori Berhasil Dihapus!";
        header("Location: index.php?act=kategori");
        exit;
    }
}  
?>