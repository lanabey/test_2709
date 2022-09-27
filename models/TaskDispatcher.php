<?php

    require_once "./config/config.php";

    class TaskDispatcher {

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

        public function addTask($username, $email, $text) {

            try {
                $query = $this->db->prepare("INSERT INTO tasks(username, email, text) VALUES (:un_val, :email_val, :text_val);");
                $query->bindValue(':un_val', trim($username), PDO::PARAM_STR);
                $query->bindValue(':email_val', trim($email), PDO::PARAM_STR);
                $query->bindValue(':text_val', $text, PDO::PARAM_STR);

                $query->execute();
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function updateTask($id, $text) {

            try {
                $query = $this->db->prepare("UPDATE tasks SET text = :text_val, edited = TRUE WHERE id = :id;");
                $query->bindValue(':id', intval($id), PDO::PARAM_STR);
                $query->bindValue(':text_val', $text, PDO::PARAM_STR);

                $query->execute();
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function completeTask($id) {

            try {
                $query = $this->db->prepare("UPDATE tasks SET status = TRUE WHERE id = :id_val;");
                $query->bindValue(':id_val', intval($id), PDO::PARAM_INT);

                $query->execute();
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getTasks($offset, $frame, $sortField = '', $sortDesc = false) {

            try {
                if (in_array($sortField, ['username', 'email', 'status'])) {
                    if ($sortDesc) {
                        $query = $this->db->prepare("SELECT * FROM tasks ORDER BY $sortField DESC LIMIT :offset, :frame;");

                    } else {
                        $query = $this->db->prepare("SELECT * FROM tasks ORDER BY $sortField LIMIT :offset, :frame;");
                    }
                } else {
                    $query = $this->db->prepare("SELECT * FROM tasks LIMIT :offset, :frame;");
                }

                $query->bindValue(':offset', intval($offset), PDO::PARAM_INT);
                $query->bindValue(':frame', intval($frame), PDO::PARAM_INT);

                $query->execute();
                $result = $query->fetchAll();
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }

            return $result ?? [];
        }

        function getTaskAmount() {

            try {
                $query = $this->db->prepare("SELECT COUNT(id) FROM tasks;");
                $query->execute();
                $result = $query->fetch();
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }

            return $result['COUNT(id)'] ?? 0;
        }
    }
