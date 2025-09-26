<?php
require_once __DIR__ . '/../core/Model.php';

class Todo extends Model{
    public $todoId;
    public $userId;
    public $todoTitle;
    public $tag;
    public $todoDescription;
    public $dueDate;
    public $dueTime;
    public $alarmStatus;
    public $alarmSound;
    public $created_at;
    public $status;
    const STATUS_PENDING   = 'pending';
    const STATUS_COMPLETED = 'completed';

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

    // UPDATE TODO INFO
    public function updateTodo($todoId) {
        $title         = $this->db->conn->real_escape_string($this->todoTitle);
        $tag           = $this->db->conn->real_escape_string($this->tag);
        $todoDescription   = $this->db->conn->real_escape_string($this->todoDescription);
        $dueDate       = $this->db->conn->real_escape_string($this->dueDate);
        $dueTime       = $this->db->conn->real_escape_string($this->dueTime);
        $alarmStatus   = $this->db->conn->real_escape_string($this->alarmStatus);
        $alarmSound    = $this->db->conn->real_escape_string($this->alarmSound);

        $sql = "UPDATE todos 
                SET todo_title     = '{$title}', 
                    tag            = '{$tag}', 
                    todo_description = '{$todoDescription}',
                    due_date       = '{$dueDate}',
                    due_time       = '{$dueTime}',
                    alarm_status   = '{$alarmStatus}',
                    alarm_sound    = '{$alarmSound}',
                    created_at     = NOW()
                WHERE todo_id = '{$todoId}' 
                AND user_id = '{$this->userId}' 
                LIMIT 1";

        if ($this->db->conn->query($sql)) {
            return true; // success
        }
        return false; // failed
    }

    // UPDATE Todo status
    public function toggleTodoStatus($todoId, $userId) {
        // Get current status
        $sql = "SELECT status FROM todos 
                WHERE todo_id = '{$todoId}' 
                AND user_id = '{$userId}' 
                LIMIT 1";
        $result = $this->db->conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            $newStatus = ($row['status'] === 'completed') ? 'pending' : 'completed';

            $updateSql = "UPDATE todos 
                        SET status = '{$newStatus}', 
                            updated_at = NOW()
                        WHERE todo_id = '{$todoId}' 
                            AND user_id = '{$this->userId}' 
                        LIMIT 1";

            if ($this->db->conn->query($updateSql)) {
                return $newStatus; // ✅ return new status instead of boolean
            }
        }

        return false; // failed
    }



    // Static finder method
    public static function find($todo_id) {
        $db = (new self())->db->conn; // create instance just to access db

        $todo_id = (int) $todo_id; // sanitize

        $sql = "SELECT * FROM todos WHERE todo_id = {$todo_id} ORDER BY created_at DESC LIMIT 1";
        $result = $db->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            $todo = new self();
            $todo->todoId    = $row['todo_id'];
            $todo->userId    = $row['user_id'];
            $todo->todoTitle   = $row['todo_title'];
            $todo->todoDescription   = $row['todo_description'];
            $todo->tag        = $row['tag'];
            $todo->dueDate        = $row['due_date'];
            $todo->dueTime        = $row['due_time'];
            // $todo->created_at = $row['created_at'];
            $todo->status = $row['status'];
            $todo->alarmStatus = $row['alarm_status'];
            $todo->alarmSound = $row['alarm_sound'];
            return $todo;
        }

        return null; // not found
    }

    // Static finder method: get all todos
    public static function getAllTodoByUserAndStatus($userId, $status, $tags=[]) {
        $db = (new self())->db->conn; 
        $userId = (int) $userId;
        $status = $db->real_escape_string($status);


        $sql = "SELECT * FROM todos WHERE user_id = {$userId} AND status = '{$status}'";

        // Apply tag filter if selected
        if (!empty($tags)) {
            $tagList = implode("','", array_map([$db, 'real_escape_string'], $tags));
            $sql .= " AND tag IN ('{$tagList}')";
        }

        $sql .= " ORDER BY updated_at DESC";

        $result = $db->query($sql);
        $todos = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $todo = new self();
                $todo->todoId   = $row['todo_id'];
                $todo->userId   = $row['user_id'];
                $todo->todoTitle = $row['todo_title'];
                $todo->tag       = $row['tag'];
                $todo->status    = $row['status'];
                $todo->created_at = $row['created_at'];
                $todos[] = $todo;
            }
        }

        return $todos;
    }

     // Count todos by status, optionally filtered by tags
    public static function countTodosByStatus($userId, $status, $tags = []) {
        $db = (new self())->db->conn;
        $userId = (int)$userId;
        $status = $db->real_escape_string($status);

        $sql = "SELECT COUNT(*) AS total FROM todos WHERE user_id = {$userId} AND status = '{$status}'";

        if (!empty($tags)) {
            $tagList = implode("','", array_map([$db, 'real_escape_string'], $tags));
            $sql .= " AND tag IN ('{$tagList}')";
        }

        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return (int)$row['total'];
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