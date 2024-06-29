<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class AuthController extends BaseController
{
    use ResponseTrait;

    public function generateApiKey()
    {
        $username = $this->request->getPost('username');
        
      
        $apiKey = bin2hex(random_bytes(16));

        $userModel = new UserModel();
        $userModel->insert([
            'username' => $username,
            'api_key' => $apiKey,
        ]);

        return $this->respond(['api_key' => $apiKey], 201);
    }
}
