<?php

namespace Src\Admin;

use Src\Models\Auth;
use Src\Core\Controller;
use CoffeeCode\Router\Router;

class AdminController extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);


        if (!Auth::user()) {
            Auth::logout();

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->redirect("auth.login");
            }

            echo json_encode(["redirect" => $this->route("auth.login")]);
            die;
        }

        $this->addData(["currentUser" => Auth::user()]);
    }
}
