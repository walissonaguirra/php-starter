<?php

namespace Src\Support;

use SendGrid;
use SendGrid\Mail\Mail;
use CoffeeCode\DataLayer\Connect;

class Email
{
    private SendGrid $sendgrid;

    private Mail $mail;

    private \Exception $fail;

    public function __construct()
    {
        $this->sendgrid = new SendGrid($_ENV['SENDGRID_API_KEY']);
    }

    /**
     * Crie um objeto email
     *
     * @param string $to
     * @param string $name
     * @param string $subject
     * @param string $body
     * @return Email
     */
    public function mail(string $to, string $name, string $subject, string $body): Email
    {
        $this->mail = new Mail();
        $this->mail->setFrom($_ENV['SENDGRID_EMAIL'], $_ENV['SENDGRID_NAME']);
        $this->mail->setSubject($subject);
        $this->mail->addTo($to, $name);
        $this->mail->addContent("text/html", $body);
        return $this;
    }

    /**
     * Enviar o objeto email
     *
     * @return boolean
     */
    public function send(): bool
    {
        try {
            $this->sendgrid->send($this->mail);
            return true;
        } catch (\Exception $exception) {
            $this->fail = $exception;
            return false;
        }
    }

    /**
     * Cria o email e salva na fila de disparo de email
     *
     * @param string $to
     * @param string $name
     * @param string $subject
     * @param string $body
     * @return boolean
     */
    public function queue(string $to, string $name, string $subject, string $body): bool
    {
        try {
            $stmt = Connect::getInstance()->prepare(
                "INSERT INTO
                    mail_queue (`subject`, `body`, `to`, `name`)
                    VALUES (:subject, :body, :to, :name)"
            );

            $stmt->bindValue(":subject", $subject, \PDO::PARAM_STR);
            $stmt->bindValue(":body", $body, \PDO::PARAM_STR);
            $stmt->bindValue(":to", $to, \PDO::PARAM_STR);
            $stmt->bindValue(":name", $name, \PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return false;
        }
    }

    /**
     * Enviar emails salvos na fila de disparo
     *
     * @param integer $perSecond
     * @return void
     */
    public function sendQueue(int $perSecond = 5)
    {
        $stmt = Connect::getInstance()->query("SELECT * FROM mail_queue WHERE sent_at IS NULL");
        if ($stmt->rowCount()) {
            foreach ($stmt->fetchAll() as $send) {
                $email = $this->mail(
                    $send->to,
                    $send->name,
                    $send->subject,
                    $send->body
                );

                if ($email->send()) {
                    usleep(1000000 / $perSecond);
                    Connect::getInstance()->exec("UPDATE mail_queue SET sent_at = NOW() WHERE id = {$send->id}");
                }
            }
        }
    }

    public function fail(): \Exception
    {
        return $this->fail;
    }
}
