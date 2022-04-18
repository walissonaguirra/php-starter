<?php

/**
 * Dotenv
 */

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

/**
 * DATA_LAYER
 */
define("DATA_LAYER_CONFIG", [
    "driver" => $_ENV["DB_DRIVE"],
    "host" => $_ENV["DB_HOST"],
    "port" => $_ENV["DB_POST"],
    "dbname" => $_ENV["DB_NAME"],
    "username" => $_ENV["DB_USERNAME"],
    "passwd" => $_ENV["DB_PASSWD"],
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", dirname(__DIR__, 1) . "/themes");
define("CONF_VIEW_ADMIN", CONF_VIEW_PATH . "/admin");
define("CONF_VIEW_EMAIL", dirname(__DIR__, 1) . "/email");

/**
 * SITE
 */
define("CONF_SITE_NAME", "PHP Starter");
define("CONF_SITE_TITLE", "Uma base para criação de sistemas");

/**
 * DEVELOPER
 */
define("CONF_DEV_WEBSITE", "https://github.com/walissonaguirra");
define("CONF_DEV_AUTHOR", "@walissonaguirra");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 6);
define("CONF_PASSWD_MAX_LEN", 20);

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_DB", "Y-m-d H:i:s");
