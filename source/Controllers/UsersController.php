<?php 

namespace Source\Controllers;

use Exception;
use Source\Models\Users;

class UsersController
{
    public function create()
    {
        $users = new Users();

        $users = new Users();
        $data = json_decode(file_get_contents("php://input"));

        try 
        {
            $users->setName($data->name);
            $users->setEmail($data->email);
            $users->setPasswd($data->passwd);
    
            $users->create();
        } 
        catch (Exception $e) 
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

    public function read()
    {
        
    }

    public function update()
    {
        $users = new Users();
    }

    public function delete()
    {
        $users = new Users();
    }
}