<?php require_once 'dbconfig.php';

if(isset($_POST['search_text']) && !empty($_POST['search_text']) ){
	$query = mysqli_query($con,"SELECT review FROM tringguide WHERE phone_model='".$_POST['search_text']."'");
	if (!$query) {
		die('No results found.');
	}
	$row = mysqli_fetch_row($query);
?>
<span class="label label-default">Click on the play button to start the review video.</span>
<!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $row[0] ?>"></iframe>
</div>
<?php
}
?>