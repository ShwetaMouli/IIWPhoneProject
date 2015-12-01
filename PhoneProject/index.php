<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Tring Guide</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/page_template.css" type="text/css">
		<link rel="stylesheet" href="css/live_search_style.css" type="text/css">
		<link rel="stylesheet" href="css/jquery-ui.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/live_search.js"></script>
	</head>
	<body class="all_background">
		<div class="container">
			<div class="jumbotron">
				<h2>Type in phone model below</h2>
				<form class="navbar-form navbar-left" role="search" method="post" action="" >
				    <div class="form-group">
				        <input type="text" name="search_text" value="<?=isset($_POST['search_text']) ? $_POST['search_text'] : ''?>" id="searchid" class="form-control" placeholder="Search for phone model">
				    </div>
				    <button type="submit" id="search_button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
				</form>
			</div>
			<ul class="nav nav-pills">
				<li class="active"><a href="#Specs" data-toggle="tab">Specifications</a></li>
				<li><a href="#trshoot" data-toggle="tab">Troubleshooting</a></li>
				<li><a href="#review" data-toggle="tab">Review</a></li>
				<li><a href="#resale" data-toggle="tab">Resale</a></li>
			</ul>
			<div class="tab-content" id="tabs">
				<div class="tab-pane active" id="Specs"><?php include 'search_phone_results.php'?></div>
				<div class="tab-pane" id="trshoot"><?php include 'extract_tips.php'?></div>
				<div class="tab-pane" id="review"><?php include 'extract_reviews.php'?></div>
				<div class="tab-pane" id="resale"><?php include 'extract_resale.php'?></div>
			</div>
		</div>
		</div>
	</body>
</html>