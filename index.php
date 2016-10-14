<? include_once("notes/site_init.tpl"); 
	show_header("NOTES");
	show_body();
	
?>


<?php include('bd.php');
	 

?>

<div id="regg">
    <div class="fa fa-camera-retro fa-5x" id="m"></div><br>
<div id="rl"><? $db->loadLists($_SESSION["email"]);?></div>
<input type="hidden" id="maill" value="<?=$_SESSION['email']?>"/>
<input type="button" name="flag" value="AddList" id="btnflg" class="btn btn-success"/>

</div>

<?	 show_footer();
?>
