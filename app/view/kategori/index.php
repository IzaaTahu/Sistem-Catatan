<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/kategori.css">
</head>
<body>
    <?php
    include "components/nav.php";
    include "components/sidebar.php";
    ?>

    <div class="container">
        <div class="card">
            <h2>Daftar Kategori</h2>
            <a href="index.php?act=kategori-tambah" class="btn btn-primary">Tambah Kategori</a>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    if(count($data_kategori) > 0 ):
                        foreach($data_kategori as $row): ?>
                        <tr>
                            <td>
                                <?= $no ?>
                            </td>
                            <td>
                                <?= $row['nama_kategori'] ?>
                            </td>
                            <td>
                                <?= $row['nama_admin'] ?>
                            </td>
                            <td>
                                <a href="index.php?act=kategori-edit&id=<?= $row['id'] ?>" class="btn-orange">Edit</a>
                                <a href="index.php?act=kategori-hapus&id=<?= $row['id'] ?>" class="btn-red" onclick="return confirm('Yakin Ingin Menghapus Kategori Ini?')">Hapus</a>
                            </td>
                        </tr>

                        <?php
                        $no++;
                        endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td>Belum Ada Kategori.</td>
                            </tr>
                        <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>