<?php
namespace AdminRedirect;
use function \Functions\{verify, array_keys_exist, login, redirect};
use const \Constants\{SUCCESS_PAGE, ERROR_PAGE};
use \DateTime;
use \Throwable;
use \Error;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';

try {
  if (array_keys_exist($_GET, 'user', 'datetime', 'hmac')) {
    if (verify(
      $_GET['user'],
      new DateTime($_GET['datetime']),
      $_GET['hmac']
      ) and login($_GET['user'])) {
        redirect(SUCCESS_PAGE);
      } else {
        throw new \Error('Invalid login attempt');
      }
  } else {
    throw new \Error('Missing required paramaters');
  }
} catch (Throwable $e) {
  redirect(ERROR_PAGE);
}
