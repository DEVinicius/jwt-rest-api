<?php 

namespace Source\Controllers;

use Source\Models\Projects;
use Source\Models\Users;

class ProjectsController
{
    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        $users = new Users();
        $projects = new Projects();

        if(!empty($data->user_id) && !empty($data->name) && !empty($data->description) && !empty($data->status))
        {
            //user_id verify
            $users->setId($data->user_id);
            if(count($users->selectById()) > 0)
            {
                $projects->setName($data->name);
                $projects->setUserId($data->user_id);
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