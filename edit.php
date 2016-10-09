<?	
	include_once("bd.php");
	$db->updateList($_POST["name"],$_POST["idd"]);
	echo $_POST["name"];
?>