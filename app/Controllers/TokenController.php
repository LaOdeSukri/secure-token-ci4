<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TokenController extends Controller
{
    public function refresh()
    {
        helper(['secure_token']);

        $secureToken = generate_secure_token();

        return $this->response->setJSON([
            'csrf_token_name'  => csrf_token(),
            'csrf_token_value' => csrf_hash(),
            'secure_token'     => $secureToken,
        ]);
    }
}
