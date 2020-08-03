<?php 

namespace Source\Controllers;

use Exception;
use Source\Models\Projects;
use Source\Models\Users;
use Firebase\JWT\JWT;

class ProjectsController
{
    private $key = "userJWT";
    private $alg = "HS256";
    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        $users = new Users();
        $projects = new Projects();

        if(!empty($data->jwt) && !empty($data->name) && !empty($data->description) && !empty($data->status))
        {
            try 
            {
                $jwt = JWT::decode($data->jwt,$this->key, array($this->alg));
                $users->setId($jwt->data->id);
                if(count($users->selectById()) > 0)
                {
                    $projects->setName($data->name);
                    $projects->setUserId($jwt->data->id);
                    $projects->setDescription($data->description);
                    $projects->setStatus($data->status);
    
                    $projects->create();
                    http_response_code(200);
                    print_r(
                        json_encode(
                            [
                                "error" => "200"
                            ]
                        )
                    );
                }
                else
                {
                    http_response_code(400);
                    print_r(
                        json_encode(
                            [
                                "error" => "Incorrect User_id"
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
            //user_id verify
        }
        else
        {
            http_response_code(400);
            print_r(
                json_encode(
                    [
                        "error" => "Empty Fields"
                    ]
                )
            );
        }
    }

    public function read()
    {

    }
}