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
<div class="hero-unit span12 columns" style="width:1000px; height:800px margin:1 auto; background:#334467;">
	<h2 align="center" style="color:#FFFFFF; margin-top:-40px;"><?=$_POST['search_text']?></h2>
	<table style="margin-top:30px">
	<?php
			for($i=0;$i<=1;$i++) {				
		?>
			<!-- <div class="item"> -->
              <!-- <img class="caro_img" src="<?= $attr[3][$i]?>" >
				<div class="carousel-caption"> -->
					
					<tr>
						<?php
			for($j=1;$j<=4;$j++) {				
		?>

						<td align="center" valign="center">
<img src="<?= $attr[3][$i]?>" alt="description here" />
<br />


					<h4><?= $attr[1][($i*4)+$j] ?>.</h4>
					<p>Price: <?= $attr[2][($i*4)+$j]?>$</p>
					</td>
						<?php } ?>
				</tr>
				<!-- </div>
			</div> -->
	<?php } ?>
	</table>



	<!-- <div id="carousel-generic" class="carousel slide" data-ride="carousel">
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
		
		 <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		 <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div> -->
</div>
<?php } ?>
