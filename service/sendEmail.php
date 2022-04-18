<?php

require dirname(__DIR__, 1) . "/vendor/autoload.php";

/**
 * Enviar fila de email
 * Set Interval 30s
 */
$emailQueue = new \Src\Support\Email();
$emailQueue->sendQueue();
