<?php
/**
 * DATABASE
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "vistasoft",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);


/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "http://localhost/vistasoft");
define("CONF_URL", "https://www.vistasoft.com.br/vistasoft");

/**
 * SITE
 */
define("CONF_SITE_NAME", "VistaSoft");
define("CONF_SITE_TITLE", "Desafio Técnico");
define("CONF_SITE_DESC", "VistaSoft");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "www.vistasoft.com.br");
define("CONF_SITE_ADDR_STREET", "");
define("CONF_SITE_ADDR_NUMBER", "");
define("CONF_SITE_ADDR_COMPLEMENT", "");
define("CONF_SITE_ADDR_CITY", "");
define("CONF_SITE_ADDR_STATE", "");
define("CONF_SITE_ADDR_ZIPCODE", "");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 6);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);


/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_ADMIN", __DIR__ . "/../../themes/admin");
define("CONF_VIEW_THEME_ADMIN", "admin");
define("CONF_VIEW_EXT", "php");


/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "");
define("CONF_SOCIAL_FACEBOOK_APP", "626590460695980");
define("CONF_SOCIAL_FACEBOOK_PAGE", "");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "");
define("CONF_SOCIAL_GOOGLE_PAGE", "");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "");
define("CONF_SOCIAL_TWITTER_PAGE", "");


/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

