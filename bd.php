<?php
	class Db{
		private function con()
		{
            $pgcon = pg_connect("host=localhost port=5432 dbname=notes user=man-dan@mail.ru password=mandan1997");
			//$mysql= new mysqli("localhost","root","","notes");
			//$mysql->query("SET NAMES 'utf8'");
			return $pgcon;
		}
		public function addList($email)
		{
            $id = Db::usId($email);
			//Db::con()->query("INSERT INTO `list`(`title`,`user_id`) VALUES('New List','$id')");
            pg_query(Db::con(),"INSERT INTO list (title, user_id) VALUES('New List','$id')");
			pg_close(Db::con());
		}
        private function usId($email)
        {
            //$id = Db::con()->query("SELECT id FROM `users` WHERE email = '$email'");
            $id = pg_query(Db::con(), "SELECT id FROM users WHERE  email = '$email'");
            $row = pg_fetch_row($id);
            return $row[0];

        }
		public function loadLists($email)
		{
            $id = Db::usId($email);
			//$res = Db::con()->query("SELECT * FROM `list` WHERE user_id = '$id' ORDER BY id DESC");
            $res = pg_query(Db::con(), "SELECT * FROM list  WHERE user_id = '$id' ORDER BY id DESC");
			while($rows = pg_fetch_assoc($res)){
				printf("<div id='article' class='%s'><br><p><div  class='mar' id='list%s'>%s </div>
				<div class='mar' id='form%s'></div><div id='ff'><a href='%s' class='edit' id='%s'><i class='fa fa-pencil-square-o  fa-lg' aria-hidden='true'></i></a></div>
				<div id='df'><a href='delete%s' class='delete' id='%s'><i class='fa fa-trash-o fa-lg' aria-hidden='true'></i></a></div>
				<br>
	            <div id='ftaa'>
	            <form action='index.php' method='post' >
	            <input type='text' name='tasktname' id='taskname' class='tsk%s' placeholder='Enter name of task'  />
	            <input type='button'  id='%s' class='adtsk' value='AddTask'/></form></div>
				</p><input type='hidden' name='idd' class='ids' id='idd' value=''/>
				<input type='hidden' name='idd'  id='idds' value=''/><br>", $rows["id"]
				,$rows["id"],$rows["title"],$rows["id"],$rows["id"],$rows["id"],$rows["id"],$rows["id"],$rows["id"],$rows["id"],$rows["id"]);
				$tasks = Db::loadTasks($rows["id"]);
				if(!empty($tasks)){
                    foreach ($tasks as $i=>$value){
                        printf("<div id='task' class='t%s' ><div  class='mar' id='et%s' >{$value}</div><div  class='mar' id='t_{$i}'></div>
                            <div id='dff'><a href='edit%s' class='ed_t' id='%s'><i class='fa fa-pencil-square-o  ' aria-hidden='true'></i></a>
                            </div><div id='ddf'><a href='delete%s' class='delt' id='%s'><i class='fa fa-trash-o ' aria-hidden='true'></i></a></div>
                            <input type='hidden' name='t_n' id='t_n'/>
                            </div>",$i,$i,$i,$i,$i,$i);
                    }
                }
                printf("<div id='dd'></div></div><br>");
			}
			pg_close(Db::con());
		}
		public function loadTasks($id_list)
		{	
			$arr = array();
			//$res = Db::con()->query("SELECT * FROM `tasks` WHERE list_id = '$id_list' ORDER BY id DESC");
            $res = pg_query(Db::con(), "SELECT * FROM tasks WHERE list_id = '$id_list' ORDER BY id DESC");
			while($rows = pg_fetch_assoc($res)){
				 $arr[$rows["id"]]= $rows["descript"];
			}
			return $arr;
		}
		public function updateList($name_list,$id)
		{
			//Db::con()->query("UPDATE `list` SET `title`= '$name_list' WHERE id = '$id'");
            pg_query(Db::con(), "UPDATE list SET title= '$name_list' WHERE id = '$id'");
            pg_close(Db::con());
		}
        public function delList($id)
        {
            //Db::con()->query("DELETE FROM `list` WHERE id = '$id'");
            //Db::con()->query("DELETE FROM `tasks` WHERE list_id = '$id'");
            pg_query(Db::con(),"DELETE FROM list WHERE id = '$id'");
            pg_query(Db::con(),"DELETE FROM tasks WHERE list_id = '$id'");
            pg_close(Db::con());
        }
        public function  addTask($id_list,$val)
        {
            //Db::con()->query("INSERT INTO `tasks`(`descript`,`list_id`) VALUES('$val','$id_list')");
            pg_query(Db::con(), "INSERT INTO tasks(descript, list_id) VALUES('$val','$id_list')");
            pg_close(Db::con());
        }
        public function delTask($id_tsk)
        {
            //Db::con()->query("DELETE FROM `tasks` WHERE id = '$id_tsk'");
            pg_query(Db::con(), "DELETE FROM tasks WHERE id = '$id_tsk'");
            pg_close(Db::con());
        }
        public function updateTask($task_nam,$id)
        {
            //Db::con()->query("UPDATE `tasks` SET `descript`= '$task_nam' WHERE id = '$id'");
            pg_query(Db::con(), "UPDATE tasks SET descript = '$task_nam' WHERE id = '$id'");
            pg_close(Db::con());
        }
        public function authUser($email,$pass){
            //$res = Db::con()->query("SELECT *	FROM `users` WHERE `email` = '$email'");
            //$res = $res->fetch_assoc();
            $con = pg_query(Db::con(), "SELECT * FROM users WHERE  email = '$email'");
            $res = pg_fetch_assoc($con);
            if($res["email"]==$email && $res["pass"]==$pass){
                $_SESSION["email"] = $email;
            }
            else{
                echo "<div id='er_em'>Неверный логин или пароль!</div>";
            }
            pg_close(Db::con());

        }
        public function regUser($email,$pass){
            //$res = Db::con()->query("SELECT `email` FROM `users` WHERE `email`= '$email'");
            $res = pg_query(Db::con(), "SELECT email FROM users WHERE  email = '$email'");
            if(pg_num_rows($res)>0){
                echo "<div id='er_m'>Уже зарегистрированы!</div>";
            }
            else{
                pg_query(Db::con(),"INSERT INTO users (email,pass) VALUES('$email','$pass')");
                $_SESSION["email"]=$email;
            }
            pg_close(Db::con());
        }
	}
	
	$db = new Db;
	
?>

