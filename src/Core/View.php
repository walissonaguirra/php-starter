<?php

namespace Src\Core;

use League\Plates\Engine;

class View
{
    private $engine;

    public function __construct()
    {
        $this->engine = new Engine();
        $this->engine->addFolder("admin", CONF_VIEW_ADMIN);
        $this->engine->addFolder("email", CONF_VIEW_EMAIL);
    }

    /**
     * Renderiza o template
     *
     * @param string $name
     * @param array $data
     * @return string
     */
    public function render($name, array $data = array()): string
    {
        return $this->engine->render($name, $data);
    }

    /**
     * Registra uma função
     *
     * @param string $name
     * @param $callback
     * @return void
     */
    public function registerFunction($name, $callback)
    {
        $this->engine->registerFunction($name, $callback);
    }

    /**
     * Adiciona variaveis global para todos os templates
     *
     * @param array $data
     * @param string $template
     * @return void
     */
    public function addData(array $data, ?string $template = null): void
    {
        $this->engine->addData($data, $template);
    }
}
