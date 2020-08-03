<?php 

namespace Source\Models;

use DateTime;
use PDOException;

class Projects
{
    private $table_name = "projects";
    
    private $id;
    private $user_id;
    private $name;
    private $description;
    private $status;
    private $created_at;
    private $updated_at;

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getUserId():int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id):void
    {
        $this->user_id = $user_id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function getDescription():string
    {
        return $this->description;
    }

    public function setDescription(string $description):void
    {
        $this->description = $description;
    }

    public function getStatus():string
    {
        return $this->status;
    }

    public function setStatus(string $status):void
    {
        $this->status = $status;
    }

    public function getCreatedAt():DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at):void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt():DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updated_at):void
    {
        $this->updated_at = $updated_at;
    }

    public function create()
    {
        $database = new Database();
        try {
            
        } catch (PDOException $e) {
            http_response_code(400);
            print_r(
                json_encode(
                    [
                        "error" => $e->getMessage()
                    ]
                )
            );
        }
    }
}