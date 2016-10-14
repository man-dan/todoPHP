<?	
	include_once("bd.php");
	$db->addList($_POST['em']);
    $db->loadLists($_POST['em']);
?>