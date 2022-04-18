<?php

namespace Src\Core;

use CoffeeCode\DataLayer\DataLayer;

abstract class Model extends DataLayer
{
    /**
     * Validar se o compo informado é unico na table
     *
     * @param string $field
     * @return boolean
     */
    protected function unique(string $field): bool
    {
        /** Create */
        if (empty($this->id)) {
            return $this
                ->find("{$field} = :e", "e={$this->$field}")
                ->count() == 0;
        }

        /** Update */
        if (!empty($this->id)) {
            return $this
                ->find("{$field} = :e AND id != :id ", "e={$this->$field}&id={$this->id}")
                ->count() == 0;
        }
    }
}
