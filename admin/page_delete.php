<?php 
// cannot delete home slug
if (isset($_GET['page']) && (strtolower(trim($_GET['page'])) != 'home') ) {
	include('../inc/functions.php');
	check_pages('../config/pages.php');
	include('../config/pages.php');
	$page_slug = strtolower( trim($_GET['page']) );
	
	$new_pages = array();
	foreach($pages as $p) {
		if ($p['page_slug'] != $page_slug) {
			$new_pages[] = $p;
		}
	}
	
	file_put_contents('../config/pages.php', '<?php $pages = '.var_export($new_pages, true).';?>');
	unlink("../pages/$page_slug.php");
	echo "Deleted";
}

//header('Location: pages.php');
?>