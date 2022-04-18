<?php

namespace Src\Support;

use Src\Core\Session;

class Csrf
{
    /**
     * Proteção de formulario contra ataque CSRF
     *
     * @return string
     */
    public static function input(): string
    {
        $session = new Session();
        $session->csrf();
        return "<input type='hidden' name='_nonce' value='" . ($session->csrf_token ?? "") . "'/>";
    }

    /**
     * Proteção contra ataque CSRF
     * @param array $request
     * @return boolean
     */
    public static function verify(array $request): bool
    {
        $session = new Session();
        $csrf = filter_var(($request["_nonce"] ?? null), FILTER_DEFAULT);

        if (empty($session->csrf_token) || empty($csrf) || $csrf !== $session->csrf_token) {
            return false;
        }

        return true;
    }
}
