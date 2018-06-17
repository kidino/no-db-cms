<?php include('utils/login_check.php'); ?>
<?php include('utils/header.php'); ?>
<link rel="stylesheet" href="smn/summernote-bs4.css">
<script src="smn/summernote-bs4.js"></script>
<?php include('../config/pages.php'); ?>
    <main role="main" class="container">

        <h1>Pages</h1>
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
 			<td><a href="page_edit.php?page=<?php echo $p['page_slug']?>" class="btn btn-sm btn-primary">Edit</a></td>
 		</tr>
 	<?php } ?>
 	</tbody>
 </table>
 </div>
<?php } else { ?>
<table class="table-striped">
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
<?php include('utils/footer.php'); ?>