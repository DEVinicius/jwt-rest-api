<?php 

namespace Source\Controllers;

use Exception;
use Source\Models\Users;
use Firebase\JWT\JWT;

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
                    http_response_code(200);
                    $users->create();
                }
                else
                {
                    http_response_code(400);
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
                http_response_code(400);
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
            http_response_code(404);
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

                $result = $users->selectByEmail();
                if(!empty($result))
                {
                    $name = $result[0]["name"];
                    $email = $result[0]["email"];
                    $passwd = $result[0]["paswd"];

                    if($data->password == $passwd)
                    {
                        http_response_code(200);
                        print_r(
                            json_encode(
                                [
                                    "error" => "Login Efetuado"
                                ]
                            )
                        );
                    }
                    else
                    {
                        http_response_code(404);
                        print_r(
                            json_encode(
                                [
                                    "error" => "Senha Inválida"
                                ]
                            )
                        );
                    }
                }
                else
                {
                    http_response_code(404);
                    print_r(
                        json_encode(
                            [
                                "error" => "Resultado não existente"
                            ]
                        )
                    );
                }
            }
            else
            {
                http_response_code(400);
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
            http_response_code(404);
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