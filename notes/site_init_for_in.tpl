<?
	session_start();
	if($_SESSION["email"]){
?>
	    <script type="text/javascript">
            window.location = "index.php";
        </script>
<?  }
	function show_header($title){

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <title><?php echo $title; ?></title>
</head>
<body>
    <header>

    </header>
<? } ?>
<? function show_body(){
?>	
	
		
<? }?>
<? function show_footer(){ ?>
<footer><div id="rights">Все права защищены &copy; <?= date('Y');?></div></footer>
</body>
</html>
<? } ?>
