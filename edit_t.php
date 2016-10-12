<?	
	include_once("bd.php");
	$db->updateTask($_POST['name'],$_POST['idd']);
	echo $_POST["name"];
?>