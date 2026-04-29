<?php
    //index.php
    session_start();

    include_once 'app/controllers/AdminController.php';
    include_once 'app/controllers/KategoriController.php';
    include_once 'app/controllers/CatatanController.php';

    //Routing Sederhana
    $action = isset($_GET['act']) ? $_GET['act'] : 'login';
    $controller = new AdminController();
    $kategoriController = new KategoriController();
    $catatanController = new CatatanController();

    switch ($action) {

    case 'register':
        $controller->viewRegister();
        break;

    case 'register-process':
        $controller->register();
        break;

    case 'login':
        $controller->index();
        break;

    case 'login-process':
        $controller->login();
        break;

    case 'dashboard':
        $controller->dashboard();
        break;

    default:
        $controller->index();
        break;
    

    case 'logout':
        $controller->logout();
        break;

    case 'kategori':
        $kategoriController->index();
        break;

    case 'kategori-tambah':
        $kategoriController->tambah();
        break;

    case 'kategori-tambah-proses':
        $kategoriController->tambahProses();
        break;

    case 'kategori-edit':
        $kategoriController->edit();
        break;

    case 'kategori-edit-proses':
        $kategoriController->editproses();
        break;

    case 'kategori-hapus':
        $kategoriController->hapus();
        break;

    case 'catatan':
        $catatanController->index();
        break;

    case 'catatan-tambah':
        $catatanController->tambah();
        break;

    case 'catatan-tambah-proses':
        $catatanController->tambahProses();
        break;

    case 'catatan-edit':
        $catatanController->edit();
        break;

    case 'catatan-edit-proses':
        $catatanController->editProses();
        break;

    case 'catatan-hapus':
        $catatanController->hapus();
        break;
    }