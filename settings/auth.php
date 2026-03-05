<?php
define('COOKIE_SECRET', 'secret_key');

function get_auth_user() {
    if (isset($_COOKIE['auth_user']) && isset($_COOKIE['auth_token'])) {
        if (hash_hmac('sha256', $_COOKIE['auth_user'], COOKIE_SECRET) === $_COOKIE['auth_token']) {
            return $_COOKIE['auth_user'];
        }
    }
    return null;
}

function set_auth_user($id) {
    $token = hash_hmac('sha256', $id, COOKIE_SECRET);
    setcookie("auth_user", $id, time() + 86400 * 30, "/", "", true, true);
    setcookie("auth_token", $token, time() + 86400 * 30, "/", "", true, true);
}

function clear_auth_user() {
    setcookie("auth_user", "", time() - 3600, "/", "", true, true);
    setcookie("auth_token", "", time() - 3600, "/", "", true, true);
}
?>