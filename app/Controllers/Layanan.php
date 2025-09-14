<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Layanan extends BaseController
{
    public function submit()
    {
        helper(['secure_token']);

        if (!validate_secure_token()) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Invalid Secure Token'
            ])->setStatusCode(403);
        }

        $data = $this->request->getJSON(true);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil diterima',
            'data'    => $data
        ]);
    }
}
