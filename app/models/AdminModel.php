<?php
    class AdminModel{
        private $connect;
        private $table_name = "admin";

        public function __construct($db)
        {
            $this->connect = $db;
        }

        //Fungsi Registrasi
        public function register($username, $password_pengguna)
        {
            $query = "INSERT INTO " . $this->table_name . "(username, password_pengguna) VALUES (:username, :password_pengguna)";
            $stmt = $this->connect->prepare($query);

            //Bersihkan Data
            $username = htmlspecialchars(strip_tags($username));

            //Hash Password untuk Keamanan
            $hashed_password = password_hash($password_pengguna, PASSWORD_DEFAULT);

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password_pengguna", $hashed_password);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }    

        //Fungsi Login Admin
        public function login($username, $password_pengguna)
        {
            $query = "SELECT id, username, password_pengguna FROM " . $this->table_name ." WHERE username = :username LIMIT 1";
            $stmt = $this->connect->prepare($query);

            $username = htmlspecialchars(strip_tags($username));
            $stmt->bindParam(":username", $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                //Verifikasi password hash
                if (password_verify($password_pengguna, $row['password_pengguna'])) {
                    return $row; //Kembalikan Data Admin Jika Login Sukses
                }
            }
            return false;
        }
    }
?>