<?php

namespace Src\Admin;

use Src\Core\Controller;

class ErrorController extends Controller
{
    public function index(array $data): void
    {
        $errcode = filter_var($data["errcode"], FILTER_SANITIZE_NUMBER_INT);

        echo $this->render("admin::error/index", [
            "errcode" => $errcode
        ]);
    }
}
