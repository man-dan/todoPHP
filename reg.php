<?  include_once("notes/site_init_for_in.tpl");
    show_header("Registration");
    show_body();
?>
<?php include('bd.php');
	if(isset($_POST["reg"])){ 
		
		if($_POST["pass1"] == $_POST["pass2"]){
			$db->regUser($_POST["mail"],$_POST["pass1"]);
		}
		else
		{
			echo "<div id='er' >Пароли должны совподать!</div>";
		}

	}
?>

<? if($_SESSION["email"]):{ echo "<div id='syc'>Вы были успешно зарегистрированы!</div>";
    echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";
} ?>
<? else:?>
<div id="reg">
    <form id="re" name="reg" method="post" action="reg.php">
        <label>Email </label><br>
        <input type="email" name="mail" id='in' placeholder="Enter your email" required/><br>
        <label>Password</label><br>
        <input type="password" name="pass1" id='in' placeholder="Enter password" required/><br>
        <label>Confirm Password</label><br>
        <input type="password" name="pass2" id='in' placeholder="Confirm password" required/><br><br>
        <div id="bt"><input type="submit" name="reg" value="Reg in" class="btn btn-success" id="btnflg" /></div>
         <div id="reg_link"><a href="auth.php" >Уже зарегистрированы?</a></div>
    </form>



<? endif;?>
</div>
<?	 show_footer();
?>

