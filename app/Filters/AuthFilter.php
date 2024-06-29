<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeader("Authorization");
        if (!$header) {
            return Services::response()->setJSON(['message' => 'Yetkisiz erişim'])->setStatusCode(401);
        }

        $token = null;
        if (preg_match('/Bearer\s(\S+)/', $header->getValue(), $matches)) {
            $token = $matches[1];
        }

        if (!$token) {
            return Services::response()->setJSON(['message' => 'Yetkisiz erişim'])->setStatusCode(401);
        }

        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
            return true;
        } catch (\Exception $e) {
            return Services::response()->setJSON(['message' => 'Yetkisiz erişim'])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here
    }
}
