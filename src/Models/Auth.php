<?php

namespace Src\Models;

use Src\Core\View;
use Src\Core\Session;
use Src\Support\Email;
use Src\Support\Passwd;

class Auth
{
    private \Exception $fail;

    public function fail(): \Exception
    {
        return $this->fail;
    }

    /**
     * Verifica se existe um usuário logado no sistema
     *
     * @return boolean
     */
    public static function logger(): bool
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return false;
        }

        return true;
    }

    /**
     * Retorna o usuário logado no sistema
     *
     * @return User|null
     */
    public static function user(): ?User
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }

        return (new User())->findById($session->authUser);
    }

    /**
     * Log-out do sistema
     *
     * @return void
     */
    public static function logout(): void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    /**
     * Registra novos usuários
     *
     * @param User $user
     * @return boolean
     */
    public function register(User $user): bool
    {
        if (!$user->save()) {
            $this->fail = $user->fail();
            return false;
        }

        return true;
    }

    /**
     * Tenta fazer login no sistema com email e senha
     *
     * @param string $email
     * @param string $passwd
     * @return User|null
     */
    private function attempt(string $email, string $passwd): ?User
    {
        if (mb_strlen($email) < 3 || mb_strlen($email) > 100) {
            $this->fail = new \PDOException("O email informado não é válido!");
            return null;
        }

        if (!$email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new \PDOException("O email informado não é válido!");
            return null;
        }

        $user = (new User())->findByEmail($email);

        if (!$user) {
            $this->fail = new \PDOException("O e-mail informado não está cadastrado");
            return null;
        }

        if (!Passwd::is($passwd)) {
            $this->fail = new \PDOException("A senha informada não confere");
            return null;
        }

        if (!Passwd::verify($passwd, $user->passwd)) {
            $this->fail = new \PDOException("A senha informada não confere");
            return null;
        }

        return $user;
    }

    /**
     * Faz a autenticação no sistema e seta Cookies
     *
     * @param string $email
     * @param string $passwd
     * @param boolean $save
     * @return boolean
     */
    public function login(string $email, string $passwd, bool $save = false): bool
    {
        $user = $this->attempt($email, $passwd);

        if (!$user) {
            return false;
        }

        if ($save) {
            setcookie("authEmail", $email, time() + 604800, "/");// 604800 = 7 dias
        } else {
            setcookie("authEmail", null, time() - 3600, "/"); // 3600 = 1 hora
        }

        // Envia notificação de acesso para email do usuário
        $view = new View();
        $subject = "[" . date("H\hi") . "] Você fez login na plataforma " . CONF_SITE_NAME . " {$user->name}?";
        $content = $view->render("email::access", [
            "subject" => $subject,
            "name" => $user->name,
            "link" => url(),
            "date" => date("d/m/Y a\s H\hi")
        ]);

        $email = new Email();
        $emailStatus = $email->queue(
            $user->email,
            $user->name,
            $subject,
            $content
        );

        if (!$emailStatus) {
            $this->fail = $email->fail();
            return false;
        }

        //LOGIN
        (new Session())->set("authUser", $user->id);
        return true;
    }

    /**
     * Gera e dispara email para recuperação de senha
     *
     * @param string $email
     * @param string $link Link para página de redefinição de senha
     * @return boolean
     */
    public function forget(string $email, $link): bool
    {
        if (mb_strlen($email) < 3 ||  mb_strlen($email) > 100) {
            $this->fail = new \PDOException("O email informado não é válido!");
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new \PDOException("O email informado não é válido!");
            return false;
        }

        $user = (new User())->findByEmail($email);

        if (!$user) {
            $this->fail = new \PDOException("O email informado não está cadastrado");
            return false;
        }

        // Envia email para recuperação de senha
        $user->forget = md5(uniqid(rand(), true));
        $user->save();

        $view = new View();
        $subject = "Recupere sua senha para acessar a plataforma " . CONF_SITE_NAME;
        $content = $view->render("email::forget", [
            "subject" => $subject,
            "name" => $user->name,
            "link" => "{$link}/{$user->email}|{$user->forget}"
        ]);

        $email = new Email();
        $email->queue(
            $user->email,
            $user->name,
            $subject,
            $content
        );

        return true;
    }

    /**
     * Redefinir senha do usuário
     *
     * @param string $email
     * @param string $code
     * @param string $passwd
     * @param string $passwd_re
     * @return boolean
     */
    public function reset(string $email, string $code, string $passwd, string $passwd_re): bool
    {
        if (mb_strlen($email) < 3 || mb_strlen($email) > 100) {
            $this->fail = new \PDOException("O email informado não é válido!");
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new \PDOException("O email informado não é válido!");
            return false;
        }

        $user = (new User())->findByEmail($email);

        if (!$user) {
            $this->fail = new \PDOException("O e-mail informado não está cadastrado");
            return false;
        }

        if ($user->forget != htmlspecialchars($code)) {
            $this->fail = new \PDOException("O código de verificação não é válido.");
            return false;
        }

        $user->passwd = $passwd;
        $user->passwd_re = $passwd_re;
        $user->forget = null;

        if (!$user->save()) {
            $this->fail = $user->fail();
            return false;
        }

        return true;
    }
}
