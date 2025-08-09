<?php
require_once 'config/database.php';

class Guide {
    private $conn;
    private $table_name = "guides";

    public $id;
    public $title;
    public $description;
    public $content;
    public $file_path;
    public $category;
    public $author_id;
    public $is_published;
    public $views;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET title=:title, description=:description, content=:content, 
                      file_path=:file_path, category=:category, author_id=:author_id, 
                      is_published=:is_published";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category = htmlspecialchars(strip_tags($this->category));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":file_path", $this->file_path);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":is_published", $this->is_published);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function getAll($published_only = false) {
        $where_clause = $published_only ? "WHERE g.is_published = 1" : "";
        
        $query = "SELECT g.*, u.first_name, u.last_name 
                  FROM " . $this->table_name . " g 
                  LEFT JOIN users u ON g.author_id = u.id 
                  " . $where_clause . " 
                  ORDER BY g.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT g.*, u.first_name, u.last_name 
                  FROM " . $this->table_name . " g 
                  LEFT JOIN users u ON g.author_id = u.id 
                  WHERE g.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->description = $row['description'];
            $this->content = $row['content'];
            $this->file_path = $row['file_path'];
            $this->category = $row['category'];
            $this->author_id = $row['author_id'];
            $this->is_published = $row['is_published'];
            $this->views = $row['views'];
            return $row;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET title=:title, description=:description, content=:content, 
                      file_path=:file_path, category=:category, is_published=:is_published 
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":file_path", $this->file_path);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":is_published", $this->is_published);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function incrementViews() {
        $query = "UPDATE " . $this->table_name . " SET views = views + 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function getCategories() {
        $query = "SELECT DISTINCT category FROM " . $this->table_name . " WHERE category IS NOT NULL AND category != ''";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>