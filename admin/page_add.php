<?php include('utils/login_check.php'); ?>
<?php include('utils/header.php'); ?>
<link rel="stylesheet" href="smn/summernote-bs4.css">
<script src="smn/summernote-bs4.js"></script>
<?php

	$page_slug = (isset($_GET['page'])) ? strtolower( trim($_GET['page']) ) : '';

	$page = "../pages/$page_slug.php";
	$error = false;
	if (!file_exists($page) || ($page_slug == '')) {
		$error = true;
	}

	include('../inc/functions.php');
	check_pages('../config/pages.php');
	include('../config/pages.php');

	if (isset($_POST['page_slug'])) {
		
		$duplicate = false;
		$page_slug = strtolower( trim($_POST['page_slug']) );
		$content = $_POST['content'];
		$label = $_POST['label'];
		foreach($pages as $p) {
			if ($p['page_slug'] == $page_slug) {
				$duplicate = true;
				break;
			}
		}

		
		if (!$duplicate && validate_slug($page_slug)) {
			// duplicate does not exists -- can update slug
			
			$pages[] = array(
				'label' => $label,
				'page_slug' => $page_slug
			);
			
			file_put_contents('../config/pages.php', '<?php $pages = '.var_export($pages, true).';?>');
			
			file_put_contents("../pages/$page_slug.php", '<?php $content = <<<EOD'."\r\n$content\r\nEOD;\r\n?>");
			
			header('Location: page_edit.php?page='.$page_slug.'&success=1');
			
		}
    
    $error = array();
    if ($duplicate) { $error[] = 'Slug already exists. Please pick another.'; }
    if (!validate_slug($page_slug)) { $error[] = 'Slug is invalid. Minimum of four characters, use only alphanumerics, dashes or underscores.'; }

	}

?>
    <main role="main" class="container">
		<a href="pages.php" class="btn btn-sm btn-primary">&larr; Back to Pages</a>
       <form action="page_add.php?page=<?php echo $page_slug?>" id="content_form" method="post">
        <h1>Add New Page <button type="submit" class="btn btn-primary float-right">Save</button></h1>
        
        <hr>
        
        <?php if (isset($error)) {
         foreach($error as $e) {
         ?>
        <p class="alert alert-danger"><?php echo $e;?></p>
        <?php } } ?>
        
        <div class="row">
        	<div class="col-sm-6">
        		
  <div class="form-group">
    <label for="exampleInputPassword1">Label</label>
    <input type="text" name="label" class="form-control" id="label" placeholder="Page label">
  </div>

        	</div>
        	
        	<div class="col-sm-6">
        		
  <div class="form-group">
    <label for="exampleInputPassword1">Page Slug</label>
    <input type="text" name="page_slug" class="form-control" id="page_slug" placeholder="Page slug" >
  </div>

        	</div>

        </div>
        
               
        <input type="hidden" name="content" id="content" value="">
    <div id="summernote"></div>
    <p>&nbsp;</p>
    
    </form>
    <script>
      $('#summernote').summernote({
        tabsize: 2,
        height: 400
      });
		
var markupStr = '<?php echo trim(preg_replace('/\s\s+/', ' ', addslashes($content)));?>';
$('#summernote').summernote('code', markupStr);		
		
		$(document).ready(function(){
			$('#content_form').on('submit', function(){
				$('#content').val( $('#summernote').summernote('code') );
				return true;
			})
		});
    </script>        
        
    </main><!-- /.container -->
<?php include('utils/footer.php'); ?>