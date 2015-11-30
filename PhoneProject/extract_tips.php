<?php require_once 'dbconfig.php';

if(isset($_POST['search_text']) && !empty($_POST['search_text']) ){
	$query = mysqli_query($con,"SELECT tipstrickslink FROM tringguide WHERE phone_model='".$_POST['search_text']."'");
	if (!$query) {
		die('No results found.');
	}
	$row = mysqli_fetch_row($query);

	$html = new DOMDocument(); 
	libxml_use_internal_errors(true); //To avoid html wrongly build warnings.
	$html->loadHTMLFile($row[0]);
	$xpath = new DOMXPath($html);
	$phone_model = $xpath->query("//*[@id='content_container']/div[2]/div[2]/a[1]");
	$tip_headings = $xpath->query("//*[@id='tip_top']/h3/a");
	$tip_content = $xpath->query("//*[@id='tip']/p[2]/text()");
	$length = $tip_headings->length;
	?>
	<div class="panel-group" id="accordion">
	<?php for ($i = 0; $i < $length; $i++) { ?>
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i?>">
				  <?= $tip_headings->item($i)->nodeValue ?>
				</a>
			  </h4>
			</div>
			<div id="collapse<?= $i?>" class="panel-collapse collapse">
			  <div class="panel-body">
					<?= $tip_content->item($i)->nodeValue ?>
			  </div>
			</div>
		</div>
	<?php
	}
	?>
	</div>
<?php } ?>