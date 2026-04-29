<?php
class CatatanModel {
    private $connect;
    private $table_name = "catatan";

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getAll() {
        $query = "SELECT catatan.*, kategori.nama_kategori, admin.username FROM " . $this->table_name . "
        LEFT JOIN kategori ON catatan.kategori_id = kategori.id
        LEFT JOIN admin ON catatan.admin_id = admin.id
        ORDER BY catatan.id DESC";

        $stmt = $this->connect->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($judul, $isi, $kategori_id, $admin_id) {
        $query = "INSERT INTO ".$this->table_name ."(judul, isi, kategori_id, admin_id) VALUES (:judul, :isi, :kategori_id, :admin_id)";
        $stmt = $this->connect->prepare($query);

        $judul = htmlspecialchars(strip_tags($judul));
        $isi = htmlspecialchars(strip_tags($isi));

        $kategori_id = !empty($kategori_id) ? $kategori_id : NULL;

        $stmt->bindParam(":judul", $judul);
        $stmt->bindParam(":isi", $isi);
        $stmt->bindParam(":kategori_id", $kategori_id);
        $stmt->bindParam(":admin_id", $admin_id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM ".$this->table_name . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $judul, $isi, $kategori_id) {
        $query = "UPDATE ". $this->table_name ." SET judul = :judul, isi = :isi, kategori_id = :kategori_id WHERE  id = :id";
        $stmt = $this->connect->prepare($query);

        $judul = htmlspecialchars(strip_tags($judul));
        $isi = htmlspecialchars(strip_tags($isi));
        $kategori_id = !empty($kategori_id) ? $kategori_id : NULL;

        $stmt->bindParam(":judul", $judul);
        $stmt->bindParam(":isi", $isi);
        $stmt->bindParam(":kategori_id", $kategori_id);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM ".$this->table_name ." WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>