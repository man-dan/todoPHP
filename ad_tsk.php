<?
    include_once("bd.php");
    $db->addTask($_POST['id'],$_POST['vval']);
?>