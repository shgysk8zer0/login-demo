<?php
namespace LoginRedirect;
use \DateTime;

const KEY          = '3NP}]PK&=->`D-F}2v*krwHUy`d+#t9J$"J7p>bX';
const ALGO         = 'sha3-512';
const USER         = 'mySpiffyUsername';
const WP_INIT      = '../wp-load.php';
define(__NAMESPACE__ . '\\IS_WP', @file_exists(WP_INIT));

/**
 * Load WP if available, returning true/false
 * @return Bool Whether or not WP script was found & loaded
 */
function wp_init(): Bool
{
  if (IS_WP) {
    try {
      require_once WP_INIT;
      return true;
    } catch (Throwable $e) {
      return false;
    }
  } else {
    return false;
  }
}

/**
 * Gets desired user for cross-site login
 * @param Void
 * @return String User
 */
function get_user(): String
{
  try {
    if (wp_init()) {
      $user = wp_get_current_user();
      return $user->user_login;
    } else {
      return USER;
    }
  } catch(Throwable $e) {
    return USER;
  }
}

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

/**
 * Generate a query string for cross-site secure login
 * @param  String  $user        User
 * @param  String  $key         HMAC key
 * @param  String  $algo        Hashing algorithm
 * @return String               Generated query string, including the "?"
 */
function generate(
  String   $user,
  String   $key  = KEY,
  String   $algo = ALGO
): String
{
  $datetime = new DateTime();
  $data = [
    'user'     => $user,
    'datetime' => $datetime->format(DateTime::W3C),
  ];
  $data['hmac'] = hash_hmac($algo, json_encode($data), $key);
  return '?' . http_build_query($data);
}

redirect('/login/' . generate(get_user()));
