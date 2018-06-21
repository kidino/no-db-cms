<?php include('utils/login_check.php'); ?>
<?php include('utils/header.php'); ?>
<link rel="stylesheet" href="smn/summernote-bs4.css">
<script src="smn/summernote-bs4.js"></script>
<?php

	$page_slug = (isset($_GET['page'])) ? trim($_GET['page']) : '';

	$page = "../pages/$page_slug.php";
	$error = false;
	if (!file_exists($page) || ($page_slug == '')) {
		$error = true;
	}

	include('../config/pages.php');
	include('../inc/functions.php');

	if (isset($_POST['page_slug'])) {
		
		$duplicate = false;
		$page_slug_update = $_POST['page_slug_update'];
		$page_slug = $_POST['page_slug'];
		$content = $_POST['content'];
		$label = $_POST['label'];
		if ($page_slug != $page_slug_update) {
			// to update page slug -- find if duplicate exists
			foreach($pages as $p) {
				if ($p['page_slug'] == $page_slug_update) {
					$duplicate = true;
					break;
				}
			}
			
		}
		
		if (!$duplicate && validate_slug($page_slug_update)) {
			// duplicate does not exists -- can update slug
			foreach($pages as $k => $p) {
				if ($p['page_slug'] == $page_slug) {
					$pages[$k]['page_slug'] = $page_slug_update;
					$pages[$k]['label'] = $label;
					
					file_put_contents('../config/pages.php', '<?php $pages = '.var_export($pages, true).';?>');
					
					break;
				}
			}
			
			unlink("../pages/$page_slug.php");
			file_put_contents("../pages/$page_slug_update.php", '<?php $content = <<<EOD'."\r\n$content\r\nEOD;\r\n?>");
			
			header('Location: page_edit.php?page='.$page_slug_update.'&success=1');
			
		}
    
    $error = array();
    if ($duplicate) { $error[] = 'Slug already exists. Please pick another.'; }
    if (!validate_slug($page_slug_update)) { $error[] = 'Slug is invalid. Minimum of four characters, use only alphanumerics, dashes or underscores.'; }

	}

	foreach($pages as $p) {
		if ($p['page_slug'] == $page_slug) {
			$this_page = $p;
			break;
		}
	}
	include($page);


?>
    <main role="main" class="container">
		<a href="pages.php" class="btn btn-sm btn-primary">&larr; Back to Pages</a>
       <form action="page_edit.php?page=<?php echo $page_slug?>" id="content_form" method="post">
        <h1>Edit Page : <?php echo $page_slug; ?> <button type="submit" class="btn btn-primary float-right">Save</button></h1>
        
        <hr>
        
        <?php if (isset($_GET['success']) && ($_GET['success'] == '1')) { ?>
        <p class="alert alert-success">Update successful</p>
        <?php } ?>
        
        <?php if (isset($error)) {
         foreach($error as $e) {
         ?>
        <p class="alert alert-danger"><?php echo $e;?></p>
        <?php } } ?>
        
        <div class="row">
        	<div class="col-sm-6">
        		
  <div class="form-group">
    <label for="exampleInputPassword1">Label</label>
    <input type="text" name="label" class="form-control" id="label" placeholder="Page label" value="<?php echo $this_page['label'];?>">
  </div>

        	</div>
        	
        	<div class="col-sm-6">
        		
  <div class="form-group">
    <label for="exampleInputPassword1">Page Slug</label>
    <input type="hidden" name="page_slug" class="form-control" id="page_slug" placeholder="Page slug" value="<?php echo $this_page['page_slug'];?>">
    <input type="text" name="page_slug_update" class="form-control" id="page_slug_update" placeholder="Page slug" value="<?php echo $this_page['page_slug'];?>">
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