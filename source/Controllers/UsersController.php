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
                        $iss = "localhost";
                        $iat = time();
                        $nbf = $iat + 10;
                        $exp = $iat + 30;
                        $aud = "my_users";

                        $data_array = array(
                            "id" => $result[0]["id"],
                            "name" => $name,
                            "email" => $email
                        );

                        $payload = [
                            "iss"=> $iss,
                            "iat"=> $iat,
                            "nbf"=> $nbf,
                            "exp"=> $exp, 
                            "aud"=> $aud,
                            "data"=> $data_array
                        ];

                        $key = "userJWT";

                        $jwt = JWT::encode($payload,$key);
                        http_response_code(200);
                        print_r(
                            json_encode(
                                [
                                    "status" => "Login Efetuado",
                                    "jwt" => $jwt
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

        $iss = "localhost";
        $iat = time();
        $nbf = $iat + 10;
        $exp = $iat + 30;
        $aud = "my_users";

        $data_array = $result;

        $payload = [
            "iss"=> $iss,
            "iat"=> $iat,
            "nbf"=> $nbf,
            "exp"=> $exp, 
            "aud"=> $aud,
            "data"=> $data_array
        ];

        $key = "readJWT";

        $jwt = JWT::encode($payload,$key);
        http_response_code(200);
        print_r(
            json_encode(
                [
                    "jwt" => $jwt
                ]
            )
        );
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