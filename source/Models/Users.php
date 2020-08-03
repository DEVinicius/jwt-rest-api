<?php 

namespace Source\Models;

use DateTime;
use PDOException;

class Users
{
    private $table_name = "users";
    //attributes
    private $id;
    private $name;
    private $email;
    private $passwd;
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

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function setEmail(string $email):void
    {
        $this->email = $email;
    }

    public function getPasswd():string
    {
        return $this->passwd;
    }

    public function setPasswd(string $passwd):void
    {
        $this->passwd = $passwd;
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

    public function select()
    {
        $database = new Database();

        try 
        {
            $result = $database->select("SELECT * FROM {$this->table_name}",[]);

            return $result;
        } 
        catch (PDOException $e) 
        {
            print_r(
                json_encode(
                    [
                        "error" => $e->getMessage()
                    ]
                )
            );
        }
    }
    
    public function selectByEmail()
    {
        $database = new Database();

        try 
        {
            $result = $database->select("SELECT * FROM {$this->table_name} WHERE email = :email",[
                ":email" => $this->getEmail()
            ]);

            return $result;
        } 
        catch (PDOException $e) 
        {
            print_r(
                json_encode(
                    [
                        "error" => $e->getMessage()
                    ]
                )
            );
        }
    }

    public function create()
    {
        $database = new Database();
        try {
            $database->query_database("INSERT INTO {$this->table_name} (name, email, paswd) VALUES(:name, :email, :passwd)", [
                ":name" => $this->getName(),
                ":email" => $this->getEmail(),
                ":passwd" => $this->getPasswd()
            ]);

            return print_r(
                json_encode(
                    [
                        "status" => "200"
                    ]
                )
            );
        } 
        catch (PDOException $e) 
        {
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