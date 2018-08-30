<?php
namespace LoginRedirect;
use function \Functions\{generate, redirect, get_user};
require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions.php';
redirect('/login/' . generate(get_user()));
