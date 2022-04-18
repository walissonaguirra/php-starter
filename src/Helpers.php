<?php

/**
 * @param string|null $path
 * @return string
 */
function url(?string $path = null): string
{
    if ($path) {
        return $_ENV["SITE_URL"] . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return $_ENV["SITE_URL"];
}

/**
 * Proteção de formulario contra ataque CSRF
 *
 * @return string
 */
function csrf_input(): string
{
    return \Src\Support\Csrf::input();
}

function price_br(float $value): string
{
    return "R$ " . number_format($value, 2, ",", ".");
}
