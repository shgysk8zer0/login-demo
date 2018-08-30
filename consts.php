<?php
namespace Constants;
const KEY          = '3NP}]PK&=->`D-F}2v*krwHUy`d+#t9J$"J7p>bX';
const ALGO         = 'sha3-512';
const LIFETIME     = '+5 seconds';
const USER         = 'mySpiffyUsername';
const SUCCESS_PAGE = '/success/';
const ERROR_PAGE   = '/error/';
const WP_INIT      = __DIR__ . '/wp-load.php';
define(__NAMESPACE__ . '\\IS_WP', @file_exists(WP_INIT));
