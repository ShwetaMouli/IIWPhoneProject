<?php require_once 'dbconfig.php';

if(isset($_POST['search_text']) && !empty($_POST['search_text']) ){
	$result = mysqli_query($con,"SELECT phone_model,announced_date,
	battery,camera,current_status,dimensions,image,display_inches,
	is_Touch,memory,os,processor,ram,resolution,url,weight FROM tringguide where phone_model ='".$_POST['search_text']."'");
	
	$img_url=null;
	$site_url=null;
	$model=null;
?>
<table class="table">
	<tbody class="tbody">
		<tr>
			<td>
			<table class="table table-bordered table-condensed">
				<tbody class="tbody">

	<?php 
		while ($row = mysqli_fetch_assoc($result)) {
			foreach($row as $key => $value) {
				if ($key == 'image') {
					$img_url=$value;
					continue;
				} elseif ($key == 'url') { 
					$site_url=$value;
					continue;
				} elseif ($key == 'phone_model') {
					$model=$value;
					continue;
				}
	?>		
				<tr>
					<td>			
						<span style="font-weight:bold"><?= $key ?></span>
					</td> 
					<?php if($value == '') { ?>
					<td>			
						<?= 'N/A' ?>	
					</td> 
					<?php } else { ?>
					<td>			
						<?= htmlspecialchars($value) ?>	
					</td> 
					<?php } ?>
				</tr> 
		
	<?php	
			 }
		}	
	?>			</tbody> 
			</table>	
			</td>
			<td>
				<h4><?= $model ?></h4>
				<img src="<?= $img_url ?>" width="304" height="225"/>
				<p>For more info, <a href="<?= $site_url ?>">click here</a></p>
			</td>
		</tr>
	</tbody>
</table>
	
<?php	
}	
?>		