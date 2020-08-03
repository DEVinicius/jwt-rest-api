<?php 

namespace Source\Controllers;

use Exception;
use Source\Models\Users;

class UsersController
{
    public function create()
    {
        $users = new Users();
        $data = json_decode(file_get_contents("php://input"));

        try 
        {
            if(!empty($data->name) && !empty($data->email) && !empty($data->password))
            {
                $users->setName($data->name);
                $users->setEmail($data->email);
                $users->setPasswd($data->password);
                
                if(count($users->selectByEmail()) == 0)
                {
                    $users->create();
                }
                else
                {
                    print_r(
                        json_encode(
                            [
                                "error" => "Email já existente"
                            ]
                        )
                    );
                }
            }
            else
            {
                print_r(
                    json_encode(
                        [
                            "error" => "Há campos vazios"
                        ]
                    )
                ); 
            }
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

    public function checkLogin()
    {
        $users = new Users();
        $data = json_decode(file_get_contents("php://input"));

        try 
        {
            if(!empty($data->email) && !empty($data->password))
            {
                $users->setEmail($data->email);
                $users->setPasswd($data->password);

                $result = $users->selectByEmailAndPassword();
            }
            else
            {
                print_r(
                    json_encode(
                        [
                            "error" => "Campos Vazios"
                        ]
                    )
                );
            }
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
        $users = new Users();

        $result = $users->select();

        print_r(json_encode($result));
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