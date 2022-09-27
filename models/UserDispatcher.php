<?php

    require_once "./config/config.php";

    class UserDispatcher {

        private $db;

        public function __construct() {

            try {
                $this->db = new PDO(DB_CONNECTION, DB_USER, DB_PASSWORD);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function __desctruct() {
            unset($this->db);
        }

        public function isAdmin($id) {
            $query = $this->db->prepare("SELECT admin FROM users WHERE id = :id;");
            $query->bindParam(":id", $id, PDO::PARAM_INT);

            if ($query->execute()) {
                if ($query->rowCount() == 1) {
                    $result = $query->fetch();
                }
            }

            return $result || false;
        }

        public function signIn($username) {

            try {
                $query = $this->db->prepare("SELECT * FROM users WHERE username = :username;");
                $query->bindParam(":username", $username, PDO::PARAM_STR);

                if ($query->execute()) {
                    if ($query->rowCount() == 1) {
                        $result = $query->fetch();
                    }
                }
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }

            return $result ?? [];
        }
    }
