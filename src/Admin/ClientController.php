<?php

namespace Src\Admin;

class ClientController extends AdminController
{
    public function index(): void
    {
        $clients = [
            // (object) [
            //     "id" => 1,
            //     "name" => "Cliente A",
            //     "email" => "cliente@mail.com.br"
            // ]
        ];

        echo $this->render("admin::client/index", [
            "clients" => $clients
        ]);
    }

    public function create(array $data): void
    {
        echo $this->render("admin::client/create");
    }
}
