<?php

namespace Src\Core;

use CoffeeCode\Router\Router;

abstract class Controller
{
    private View $view;

    private Router $router;

    public function __construct(Router $router)
    {
        $this->view = new View();
        $this->view->registerFunction("route", [$router, "route"]);

        $this->router = $router;
    }

    /**
     * Renderiza o template
     *
     * @param string $name
     * @param array $data
     * @return string
     */
    protected function render($name, array $data = array()): string
    {
        return $this->view->render($name, $data);
    }

    /**
     * Adiciona variaveis global para todos os templates
     *
     * @param array $data
     * @param string|null $template
     * @return void
     */
    protected function addData(array $data, ?string $template = null): void
    {
        $this->view->addData($data, $template);
    }

    /**
     * Retorna a url para rota nomeada
     *
     * @param string $name
     * @param array|null $data
     * @return string|null
     */
    protected function route(string $name, array $data = null): ?string
    {
        return $this->router->route($name, $data);
    }

    /**
     * Redirenciona para rota nomeda
     *
     * @param string $name
     * @param array|null $data
     * @return void
     */
    protected function redirect(string $name, array $data = null): void
    {
        $this->router->redirect($name, $data);
    }
}
