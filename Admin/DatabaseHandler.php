<?php
require_once('../assets/db/db-config.php');

class DatabaseHandler
{
    private $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }


    public function getUsers()
    {
        $query = "SELECT id, name, mail, role, verified FROM users";
        $result = mysqli_query($this->db, $query);

        if (!$result) {
            die("Error fetching users: " . mysqli_error($this->db));
        }

        $users = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        return $users;
    }
    public function getNotices()
    {
        $query = "SELECT notice_id, title, visibility, date FROM notice";
        $query = "SELECT notice_id, title, visibility, date
              FROM notice
              ORDER BY date DESC";

        $result = mysqli_query($this->db, $query);

        if (!$result) {
            die("Error fetching notices: " . mysqli_error($this->db));
        }

        $notices = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $notices[] = $row;
        }

        return $notices;
    }
    public function getNotice($id = NULL)
    {
        if ($id === null) {
            $query = "SELECT notice_id, title, description, visibility, date, updated_by FROM notice";
        } else {

            $query = "SELECT notice_id, title,	description, visibility, date, updated_by FROM notice WHERE notice_id=$id";
        }
        $result = mysqli_query($this->db, $query);

        if (!$result) {
            die("Error fetching notices: " . mysqli_error($this->db));
        }

        return $result;
    }
}
