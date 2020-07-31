<?php 

namespace Source\Controllers;

class ErrorController
{
	public function error($data)
	{
		$error_array = [
			"error" => $data['errcode'],
		];
		
		print_r(json_encode($error_array));
	}
}