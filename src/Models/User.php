<?php

namespace Src\Models;

use Src\Core\Model;
use Src\Support\Passwd;

class User extends Model
{
    public string $passwd_re;

    public function __construct()
    {
        parent::__construct("users", [
            "name",
            "email",
            "passwd"
        ]);
    }

    /**
     * Valida o objecto usuário
     *
     * @return boolean
     */
    private function validate(): bool
    {
        if (mb_strlen($this->name) < 3 || mb_strlen($this->name) > 100) {
            $this->fail = new \PDOException("O nome informado não é válido!");
            return false;
        }

        if (!$this->validEmail()) {
            return false;
        }

        if (!Passwd::confirm($this->passwd, ($this->passwd_re ?? null))) {
            $this->fail = Passwd::fail();
            return false;
        }

        if (!Passwd::is($this->passwd)) {
            $this->fail = Passwd::fail();
            return false;
        }

        return true;
    }

    /**
     * Valida campo de email
     *
     * @return boolean
     */
    private function validEmail(): bool
    {
        if (mb_strlen($this->email) < 3 || mb_strlen($this->email) > 100) {
            $this->fail = new \PDOException("O email informado não é válido!");
            return false;
        }

        if (!$this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new \PDOException("O email informado não é válido!");
            return false;
        }

        if (!$this->unique("email")) {
            $this->fail = new \PDOException("O email informado já esta cadastrado");
            return false;
        }

        return true;
    }

    /**
     * Salva o usuário
     *
     * @return boolean
     */
    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->passwd = Passwd::hash($this->passwd);

        return  parent::save();
    }

    /**
     * Burca por email
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->find("email = :e", "e={$email}")->fetch();
    }
}
