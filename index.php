<?php
	$page_slug = (isset($_GET['page'])) ? trim($_GET['page']) : 'home';
	if ($page_slug == '') { $page = 'home'; }

	$page = "pages/$page_slug.php";

	if (!file_exists($page)) {
		$page = 'pages/404.php';
	}

	include('config/pages.php');

?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>No DB CMS</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

<style>
	main {
		padding-top: 30px;
		padding-bottom: 100px;
		min-height: 400px;
		background-color: #fff;
	}
	
	body {
		background-color: #333;
	}
	
	footer {
		background-color: #333;
		color: #fff;
	}
	
	#sidebar  {
		border-right: 1px dotted #ccc;
	}
</style>
	</head>

  <body>
    
<!-- As a heading -->
<nav class="navbar navbar-light bg-light">
  <span class="navbar-brand mb-0 h1">NODBCMS</span>
</nav>    
<main>
<div class="container-fluid">
	
	<div class="row">
		<div class="col-md-3 col-lg-2" id="sidebar">
			<ul class="nav flex-column nav-pills">
		  <?php foreach($pages as $m) {
				$active = '';
				if ($m['page_slug'] == $page_slug) {
					$active = ' active';
				}
				?>
			  <li class="nav-item">
				<a class="nav-link<?php echo $active;?>" href="index.php?page=<?php echo $m['page_slug'];?>"><?php echo $m['label'];?></a>
			  </li>		  
		  <?php } ?>
			</ul>
		</div>
		<div class="col-md-9 col-lg-10">
		<?php 
			include($page); 
			echo $content; 
		?>
		</div>
	</div>
	
</div>
	  </main>
	  
<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<p>Hakcipta terpelihara</p>
			</div>
		</div>
	</div>
</footer>
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>
