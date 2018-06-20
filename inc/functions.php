<?php

$str = "";
function validate_slug($str) {

  // each array entry is an special char allowed
  // besides the ones from ctype_alnum
  $allowed = array("-", "_");

  if ( ctype_alnum( str_replace($allowed, '', $str ) ) ) {
    return true;
  } 
    return false;
}
