<?php
class KategoriModel {
    private $connect;
    private $table_name = "kategori";

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getAll() {
        $query = "SELECT kategori.*,admin.username AS nama_admin FROM ".$this->table_name ."
        JOIN admin ON kategori.admin_id = admin.id
        ORDER BY kategori.id DESC";

        $stmt = $this->connect->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cekKategoriAda($nama_kategori) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE nama_kategori = :nama LIMIT 1";
        $stmt = $this->connect->prepare($query);

        $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));
        $stmt->bindParam(":nama", $nama_kategori);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true; //Kategori Sudah Ada
        }
        return false; //Kategori Belum Ada
    }

    public function create($nama_kategori, $admin_id) {
        $query = "INSERT INTO " . $this->table_name . " (nama_kategori, admin_id) VALUES (:nama, :admin_id)";
        $stmt = $this->connect->prepare($query);

        //Bersihkan Data
        $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));

        $stmt->bindParam(":nama", $nama_kategori);
        $stmt->bindParam(":admin_id", $admin_id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    public function update($id, $nama_kategori) {
        $query = "UPDATE " . $this->table_name . " SET nama_kategori = :nama WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        //Bersihkan Data
        $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));

        $stmt->bindParam(":nama", $nama_kategori);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>