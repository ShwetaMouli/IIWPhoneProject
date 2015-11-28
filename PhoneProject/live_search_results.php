<?php
require_once 'dbconfig.php';

if($_GET['type'] == 'phone_model'){
	$result = mysqli_query($con,"SELECT phone_model, image FROM phonescoop where phone_model LIKE '%".$_GET['name_startsWith']."%' LIMIT 10 ");	
	$data = array();
	while ($row = mysqli_fetch_array($result)) {
		array_push($data, array('label'=>$row['phone_model'],'image'=>$row['image']));	
	}	
	echo json_encode($data);
}

?>