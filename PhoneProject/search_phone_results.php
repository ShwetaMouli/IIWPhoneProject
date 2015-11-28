<?php require_once 'dbconfig.php';

if(isset($_POST['search_text']) && !empty($_POST['search_text']) ){
	$data = array();
	$result = mysqli_query($con,"SELECT phone_model FROM phonescoop where phone_model LIKE '%".$_POST['search_text']."%'");	
?>

	<h4>Search results:</h4>
	<table class="table table-bordered table-condensed table-hover">
		<thead>
			<tr>
				<th>Phones</th>
			</tr>
		</thead>
			<tbody class="tbody">

<?php 
	while ($row = mysqli_fetch_array($result)) {
		array_push($data, $row['phone_model']);	
?>		
		<tr>
			<td>			
				<?php echo htmlspecialchars($row['phone_model']); $flag=1; ?>	
			</td> 
		</tr> 
	
<?php	
	}	
?>			</tbody> 
	</table>		

<?php	
}	
?>		