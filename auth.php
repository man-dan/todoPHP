<?  include_once("notes/site_init_for_in.tpl");
    show_header("Authorization");
	show_body();
?>
<?php include('bd.php');
	if(isset($_POST["reg"])){
        $db->authUser($_POST["mail"],$_POST["pass1"]);
    }
    if($_SESSION['email'])
    {
        echo "<script>window.location = 'index.php';</script>";
    }
?>
<div id="reg">
<form id="re" name="auth" method="post" action="auth.php">
 <label>Email </label><br>
<input type="email" name="mail" id='in' placeholder="Enter your email" required/><br>
 <label>Password</label><br>
<input type="password" name="pass1" id='in' placeholder="Enter your password" required minlength='7'/><br><br>
<div id="bt"><input type="submit" name="reg" value="Log in" class="btn btn-success"  id="btnflg" /></div>
    <div id="reg_link"><a href="reg.php" >Не зарегистрированы?</a></div>
</form>

</div>
<?	 show_footer();
?>
