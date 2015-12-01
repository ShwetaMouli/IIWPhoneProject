<?php require_once 'dbconfig.php';

if(isset($_POST['search_text']) && !empty($_POST['search_text']) ){
	$query = mysqli_query($con,"SELECT phone_model,phoneSpecs,phonePrices,phoneImgsUsed FROM tringguide WHERE phone_model='".$_POST['search_text']."'");
	if (!$query) {
		die('No results found.');
	}
	$attr=array();
	while ($row = mysqli_fetch_assoc($query)) {
		$i=0;
		foreach($row as $key => $value) {
			$attr[$i]=explode('*delim*', $value);
			++$i;
		}
	}
	$length=sizeof($attr[1]);
?>
<div class="hero-unit span12 columns" style="width:1000px; height:800px margin:1 auto;">
	<h2><?=$_POST['search_text']?></h2>
	<div id="carousel-generic" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<div class="item active">
              <img class="caro_img" src="<?= $attr[3][0]?>" >
				<div class="carousel-caption">
					<h4><?= $attr[1][0] ?></h4>
					<p>Price: <?= $attr[2][0]?>$</p>
				</div>
			</div>
		<?php
			for($i=1;$i<$length;$i++) {				
		?>
			<div class="item">
              <img class="caro_img" src="<?= $attr[3][$i]?>" >
				<div class="carousel-caption">
					<h4><?= $attr[1][$i] ?></h4>
					<p>Price: <?= $attr[2][$i]?>$</p>
				</div>
			</div>
	<?php } ?>
		</div>
		<!-- Controls -->
		 <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		 <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>
<?php } ?>
