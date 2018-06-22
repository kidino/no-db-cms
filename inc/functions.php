<?php

// kita guna ni nak pastikan input dari $_GET bersih daripada
// cubaan injection dan include file yang tidak dikehendaki
function validate_slug($str) {

  // each array entry is an special char allowed
  // besides the ones from ctype_alnum
  $allowed = array("-", "_");
  $prevented_slug = array('404','index');

  if ( 
      ctype_alnum( str_replace($allowed, '', $str ) ) // must match alphanum, dash & underscore only
      && (!in_array($str, $prevented_slug)) // not in prevented words
      && (strlen($str) >= 4) // must be over 4 characters
  ) {
    return true;
  } 
    return false;
}

// sebelum kita include config/pages.php, kita check dulu dia
// ada ke tak. kalau takde, kita create baru.
function check_pages($loc) {
	if (!file_exists($loc)) {
		$default_pages = array(array('label' => 'Home', 'page_slug' => 'home'));
		file_put_contents($loc, '<?php $pages = '.var_export($default_pages, true).';?>');		
	}
}