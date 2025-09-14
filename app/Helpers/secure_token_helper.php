<?php

if (!function_exists('generate_secure_token')) {
    function generate_secure_token(): string
    {
        $token = bin2hex(random_bytes(32));
        session()->set('secure_token', $token);
        return $token;
    }
}

if (!function_exists('validate_secure_token')) {
    function validate_secure_token(): bool
    {
        $request = service('request');
        $tokenHeader = $request->getHeaderLine('X-SECURE-TOKEN');
        $tokenSession = session()->get('secure_token');

        return hash_equals((string)$tokenSession, (string)$tokenHeader);
    }
}
