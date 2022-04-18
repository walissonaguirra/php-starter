<?php

namespace Src\Admin;

class PanelController extends AdminController
{
    public function index(): void
    {
        echo $this->render("admin::panel/index");
    }
}
