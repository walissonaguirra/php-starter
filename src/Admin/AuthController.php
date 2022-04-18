<?php

namespace Src\Admin;

use Src\Models\Auth;
use Src\Support\Csrf;
use Src\Core\Controller;
use CoffeeCode\Router\Router;

class AuthController extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);

        if (Auth::logger()) {
            $this->redirect("panel.index");
            die;
        }
    }

    public function login(array $data): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // CSRF
            if (!Csrf::verify($data)) {
                echo json_encode([ "type" => "danger", "message" => "Error ao enviar, favor use o formulario"]);
                return;
            }

            // Autenticação
            $auth = new Auth();
            $logger = $auth->login(
                ($data["email"] ?? ""),
                ($data["passwd"] ?? ""),
                (bool) ($data["remenber_me"] ?? false)
            );

            if (!$logger) {
                echo json_encode([ "type" => "danger", "message" => $auth->fail()->getMessage()]);
                return;
            }

            // Redirect
            echo json_encode(["redirect" => $this->route("panel.index")]);
            return;
        }

        $cookieEmail = filter_input(INPUT_COOKIE, "authEmail", FILTER_SANITIZE_EMAIL);
        echo $this->render("admin::auth/login", [
            "cookieEmail" => $cookieEmail
        ]);
    }

    public function forget(array $data): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // CSRF
            if (!Csrf::verify($data)) {
                echo json_encode([ "type" => "danger", "message" => "Error ao enviar, favor use o formulario"]);
                return;
            }

            // Enviar email para recuperação de senha
            $auth = new Auth();
            $forget = $auth
                ->forget($data["email"] ?? "", $this->route("auth.forget"));

            if (!$forget) {
                echo json_encode(["type" => "danger", "menssage" => $auth->fail()->getMessage()]);
                return;
            }

            // Redireciona para página de login
            echo json_encode(["redirect" => $this->route("auth.login")]);
            return;
        }

        $cookieEmail = filter_input(INPUT_COOKIE, "authEmail", FILTER_SANITIZE_EMAIL);
        echo $this->render("admin::auth/forget", [
            "cookieEmail" => $cookieEmail
        ]);
    }

    public function reset(array $data): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            /**
             * Redefinir senha
             */
            list($email, $forgetCode) = explode("|", $data["code"] ?? "|");

            $auth = new Auth();
            $reset = $auth->reset(
                $email,
                $forgetCode,
                $data["passwd"] ?? "passwd",
                $data["passwd_re"] ?? "passwd_re"
            );

            if (!$reset) {
                echo json_encode(["type" => "danger","message" => $auth->fail()->getMessage()]);
                return;
            }

            /**
             * Redirect
             */
            echo Json_encode(["redirect" => $this->route("auth.login")]);
            return;
        }

        $forgetCode = filter_var($data["code"] ?? null, FILTER_SANITIZE_URL);

        if (!$forgetCode) {
            $this->redirect("auth.login");
            return;
        }

        echo $this->render("admin::auth/reset", [
            "forgetCode" => $forgetCode
        ]);
    }
}
