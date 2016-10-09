<? include_once("notes/site_init.tpl"); 
	show_header("NOTES");
	show_body();
	
?>


<?php include('bd.php');
	 

?>
<div id="regg">
 <div class="fa fa-camera-retro fa-5x" id="m"></div>
<div id="rl"><? $db->loadLists();?></div>

<input type="button" name="flag" value="AddList" id="btnflg" class="btn btn-success"/>

</div>

<?	 show_footer();
?>
