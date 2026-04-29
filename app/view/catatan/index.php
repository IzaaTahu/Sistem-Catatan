<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/catatan.css">
</head>
<body>
    <?php
    include "components/nav.php";
    include "components/sidebar.php";
    ?>

    <div class="container" style="margin-top: 80px;">
        <div class="card">
            <h2>Daftar Catatan</h2>
            <a href="index.php?act=catatan-tambah" class="btn btn-primary">Tambah Catatan Baru</a>

            <?php if (isset($_SESSION['success_msg'])): ?>
                <div class="success-message">
                    <?= $_SESSION['success_msg']; ?>
                </div>
                <?php
                unset($_SESSION['success_msg']);
                ?>
            <?php endif; ?>

            <div class="sticky-container">
                <?php if (count($data_catatan) > 0) : ?>
                    <?php foreach ($data_catatan as $row) : ?>

                        <div class="sticky-note">
                            <h3 class="note-title"><?= htmlspecialchars($row['judul']) ?></h3>

                            <div class="note-body">
                                <?= nl2br(htmlspecialchars($row['isi'])) ?>
                            </div>

                            <div class="note-meta">
                                <strong>Kategori:</strong> <?= $row['nama_kategori'] ? htmlspecialchars($row['nama_kategori']) : '<i>Tidak Ada</i>' ?><br>
                                <strong>Dibuat Oleh:</strong> <?= $row['username'] ? htmlspecialchars($row['username']) : '<i>Tidak Diketahui</i>' ?><br>
                            </div>

                            <div class="note-actions">
                                <a href="index.php?act=catatan-edit&id=<?= $row['id'] ?>" class="btn-orange">Edit</a>
                                <a href="index.php?act=catatan-hapus&id=<?= $row['id'] ?>" class="btn-red" onclick="return confirm('Yakin Ingin Menghapus Catatan Ini?')">Hapus</a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else : ?>
                    <p style="text-align: center; color: #777; width: 100%;">Tidak ada catatan yang ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>