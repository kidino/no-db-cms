<?php

$str = "";
function validate_slug($str) {

  // each array entry is an special char allowed
  // besides the ones from ctype_alnum
  $allowed = array("-", "_");
  $prevented_slug = array('404','index','home');

  if ( 
      ctype_alnum( str_replace($allowed, '', $str ) ) // must match alphanum, dash & underscore only
      && (!in_array($str, $prevented_slug)) // not in prevented words
      && (strlen($str) >= 4) // must be over 4 characters
  ) {
    return true;
  } 
    return false;
}

function check_pages($loc) {
	if (!file_exists($loc)) {
		$default_pages = array(array('label' => 'Home', 'page_slug' => 'home'));
		file_put_contents($loc, '<?php $pages = '.var_export($default_pages, true).';?>');		
	}
}