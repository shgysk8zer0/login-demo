<?php
namespace AdminRedirect;
use function \Functions\{verify, array_keys_exist, login, redirect};
use \DateTime;
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';

if (array_keys_exist($_GET, 'user', 'url', 'datetime', 'hmac')) {
  if (verify(
    $_GET['user'],
    $_GET['url'],
    new DateTime($_GET['datetime']),
    $_GET['hmac']
  ) and login($_GET['user'])) {
    redirect($_GET['url']);
  } else {
    http_response_code(404);
  }
} else {
  http_response_code(404);
}
