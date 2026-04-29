<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/catatanEdit.css">
</head>
<body>
    <?php
    include "components/nav.php";
    ?>
    <div class="container">
        <div class="card">
            <h2>Edit Catatan</h2>
            <a href="index.php?act=catatan" class="btn btn-primary">Kembali</a>

            <?php if (isset($_SESSION['error_msg'])) : ?>
                <div class="error-message" style="margin-top: 15px">
                    <?= $_SESSION['error_msg']; ?>
                </div>
                <?php
                unset($_SESSION['error_msg']);
                ?>
            <?php endif; ?>

            <form action="index.php?act=catatan-edit-proses" method="post" style="margin-top: 20px">
                <input type="hidden" name="id" value="<?= $catatan['id'] ?>">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Judul Catatan</label>
                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($catatan['judul']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="" style="display: block; margin-bottom: 5px; font-weight: bold;">Pilih Kategori</label>
                    <select name="kategori_id" class="form-control">
                        <option value="">-- Tanpa Kategori --</option>
                        <?php if (isset($data_kategori) && count($data_kategori) > 0) : ?>
                            <?php foreach($data_kategori as $kat) : ?>
                                <option value="<?= $kat['id'] ?>" <?= ($catatan['kategori_id'] == $kat['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($kat['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">isi Catatan</label>
                    <textarea name="isi" class="form-control" rows="5" required><?= htmlspecialchars($catatan['isi']) ?></textarea>
                </div>

                <button type="submit">Update Catatan</button>
            </form>
        </div>
    </div>
</body>
</html>