<?php 

namespace Source\Controllers;

use Exception;
use Source\Models\Users;

class UsersController
{
    public function create()
    {
        print_r(json_encode(["eee"=>"eeee"]));
        // $users = new Users();

        // $users = new Users();
        // $data = json_decode(file_get_contents("php://input"));

        // try 
        // {
        //     $users->setName($data->name);
        //     $users->setEmail($data->emaidl);
        //     $users->setPasswd($data->passwd);
    
        //     $user = $users->create();
        //     print_r($user);
        // } 
        // catch (Exception $e) 
        // {
        //     print_r(
        //         json_encode(
        //             [
        //                 "error" => $e->getMessage()
        //             ]
        //         )
        //     );
        // }
    }

    public function read()
    {
        $users = new Users();
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