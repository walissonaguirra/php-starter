<?php

namespace Src\Admin;

use Src\Models\Auth;
use Src\Models\User;

class UserController extends AdminController
{
    public function index(): void
    {
        $users = (new User())
            ->find()
            ->fetch(true) ?? [];

        echo $this->render("admin::user/index", [
            "users" => $users
        ]);
    }

    public function modal(array $data): void
    {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
        $user = (new User())->findById($id);
        $method = "POST";
        $action = $this->route("user.create");

        if ($user) {
            $method = "PUT";
            $action = $this->route("user.update", ["id" => $user->id]);
        }

        $html = $this->render("admin::user/inc/form", [
            "method" => $method,
            "action" => $action,
            "user" => $user ? $user->data() : null
        ]);

        echo json_encode(["html" => $html]);
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect("auth.login");
    }

    public function create(array $data): void
    {
        $user = new User();
        $user->name = $data["name"] ?? null;
        $user->email = $data["email"] ?? null;
        $user->passwd = $data["passwd"] ?? null;
        $user->passwd_re = $data["passwd_re"] ?? null;

        if (!$user->save()) {
            echo json_encode(["type" => "danger", "message" => $user->fail()->getMessage()]);
            return;
        }

        echo json_encode(["redirect" => $this->route("user.index")]);
    }

    public function update(array $data): void
    {
        $id = filter_var(($data["id"] ?? 0), FILTER_SANITIZE_NUMBER_INT);
        $user = (new User())->findById($id);

        if (!$user) {
            echo json_encode(["redirect" => $this->route("user.index")]);
        }

        $user->name = $data["name"] ?? null;
        $user->email = $data["email"] ?? null;

        if (!empty($data["passwd"])) {
            $user->passwd = $data["passwd"] ?? null;
            $user->passwd_re = $data["passwd_re"] ?? null;
        }

        if (!$user->save()) {
            echo json_encode(["type" => "danger", "message" => $user->fail()->getMessage()]);
            return;
        }

        echo json_encode(["reload" => true]);
    }

    public function delete(array $data): void
    {
        $id = filter_var(($data["id"] ?? 0), FILTER_SANITIZE_NUMBER_INT);
        $user = (new User())->findById($id);

        if (!$user) {
            echo json_encode(["redirect" => $this->route("user.index")]);
            return;
        }

        if ($user->id == Auth::user()->id) {
            echo json_encode(["type" => "danger", "message" => "Você não pode se auto apagar"]);
            return;
        }

        $user->destroy();
        echo json_encode(["redirect" => $this->route("user.index")]);
    }
}
