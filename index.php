<?php
namespace LoginDemo;

/**
 * Redirect to a given $url
 * @param  String  $url       The URL to redirect to
 * @param  Bool    $permenant Whether or not it should be a permenant redirect
 * @return Void
 */
function redirect(String $url = '/', Bool $permanent = false): Void
{
  header(sprintf('Location: %s', $url), true, $permanent ? 301 : 302);
  exit();
}

redirect('/from/');
