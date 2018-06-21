<?php include('utils/login_check.php'); ?>
<?php include('utils/header.php'); ?>
<link rel="stylesheet" href="smn/summernote-bs4.css">
<script src="smn/summernote-bs4.js"></script>
<?php 
	include('../inc/functions.php');
	check_pages('../config/pages.php');
	include('../config/pages.php');
?>
    <main role="main" class="container">

        <h1>Pages <a href="page_add.php" class="btn btn-primary float-right">New Page</a></h1>
 <?php if (count($pages) > 0) { ?>
 <div class="responsive-table">
 <table class="table table-striped">
 	<thead>
 		<tr>
 			<th>Slug</th>
 			<th>Label</th>
 			<th> </th>
 		</tr>
 	</thead>
 	<tbody>
 	<?php foreach($pages as $p) {?>
 		<tr>
 			<td><?php echo $p['page_slug'];?></td>
 			<td><?php echo $p['label'];?></td>
 			<td width="200" align="right">
 				<a target="_blank" href="../index.php?page=<?php echo $p['page_slug']?>" class="btn btn-sm btn-info">View</a>
 				<a href="page_edit.php?page=<?php echo $p['page_slug']?>" class="btn btn-sm btn-primary">Edit</a>
 				<a href="javascript:go_delete('<?php echo $p['page_slug']?>')" class="btn btn-sm btn-danger">Delete</a>
 			</td>
 		</tr>
 	<?php } ?>
 	</tbody>
 </table>
 </div>
<?php } else { ?>
<table class="table-striped table">
 	<thead>
 		<tr>
 			<th>Slug</th>
 			<th>Label</th>
 			<th> </th>
 		</tr>
 	</thead>
	<tbody>
		<tr>
			<td colspan="3">No pages was created</td>
		</tr>
	</tbody>
</table>
<?php } ?>
    </main><!-- /.container -->
<script>
function go_delete(slug) {
	if (confirm('Confirm delete page '+slug+'?')) {
		window.location.href = 'page_delete.php?page='+slug;
	}
}
</script>
<?php include('utils/footer.php'); ?>