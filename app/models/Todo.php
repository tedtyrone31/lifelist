<?php
require_once __DIR__ . '/../core/Model.php';

class Todo extends Model{
    public $todoId;
    public $userId;
    public $todoTitle;
    public $tag;
    public $created_at;
    public $status;
    public $alarm_status;

    // Save new todo on object state
    public function save() {

        $title = $this->db->conn->real_escape_string($this->todoTitle);
        $tag   = $this->db->conn->real_escape_string($this->tag);

        $sql = "INSERT INTO todos (user_id, todo_title, tag, created_at) 
                  VALUES ('{$this->userId}', '{$this->todoTitle}', '{$this->tag}', NOW())";

        if ($this->db->conn->query($sql)) {
            $this->todoId = $this->db->conn->insert_id; // return todo ID
            return $this;
        }
        return false; // failed
    }

    // Static finder method
    public static function find($todo_id) {
        $db = (new self())->db->conn; // create instance just to access db

        $id = (int) $todo_id; // sanitize

        $sql = "SELECT * FROM todos WHERE todo_id = {$todo_id} LIMIT 1";
        $result = $db->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            $todo = new self();
            $todo->todoId    = $row['todo_id'];
            $todo->userId    = $row['user_id'];
            $todo->todoTitle      = $row['todo_title'];
            $todo->tag        = $row['tag'];
            $todo->created_at = $row['created_at'];
            $todo->status = $row['status'];
            $todo->alarm_status = $row['alarm_status'];
            return $todo;
        }

        return null; // not found
    }

    // Static finder method: get all todos
    public static function getAllByUser($user_id) {
        $db = (new self())->db->conn; // create instance just to access db

        $sql = "SELECT * FROM todos WHERE user_id = {$user_id} ORDER BY created_at DESC";
        $result = $db->query($sql);

        $todos = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $todo = new self();
                $todo->todoId         = $row['todo_id'];
                $todo->userId    = $row['user_id'];
                $todo->todoTitle      = $row['todo_title'];
                $todo->tag        = $row['tag'];
                $todo->created_at = $row['created_at'];
                $todos[] = $todo;
            }
        }

        return $todos; // returns array (possibly empty)
    }

    // Static method: delete a todo by ID
    public static function deleteById($todo_id, $user_id) {
        $db = (new self())->db->conn;

        // It's safer to include user_id in the WHERE clause 
        // so a user cannot delete someone else's todo
        $sql = "DELETE FROM todos WHERE todo_id = {$todo_id} AND user_id = {$user_id} LIMIT 1";

        $result = $db->query($sql);

        return $result ? true : false; // return boolean
    }
}


?>