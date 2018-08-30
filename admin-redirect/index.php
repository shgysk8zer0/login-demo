<?php
namespace AdminRedirect;
use function \Functions\{verify, array_keys_exist, login, redirect};
use const \Constants\{DESTINATION};
use \DateTime;
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';

if (array_keys_exist($_GET, 'user', 'datetime', 'hmac')) {
  if (verify(
    $_GET['user'],
    new DateTime($_GET['datetime']),
    $_GET['hmac']
  ) and login($_GET['user'])) {
    redirect(DESTINATION);
  } else {
    http_response_code(404);
  }
} else {
  http_response_code(404);
}
