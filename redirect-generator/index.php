<?php
namespace LoginRedirect;
use function \Functions\{generate, redirect, get_user};
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';
redirect('/admin-redirect/' . generate(get_user()));
