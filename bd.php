<? 
	class Db{
		private function con()
		{
			$mysql= new mysqli("localhost","root","","notes");
			$mysql->query("SET NAMES 'utf8'");
			return $mysql;
		}
		public function addList()
		{	
			Db::con()->query("INSERT INTO `list`(`title`,`user_id`) VALUES('New List','1')");
			Db::con()->close();
		}
		public function loadLists()
		{	
			$res = Db::con()->query("SELECT * FROM `list` WHERE user_id = '1' ORDER BY id DESC");
			while($rows = $res->fetch_assoc()){
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
			Db::con()->close();
		}
		public function loadTasks($id_list)
		{	
			$arr = array();
			$res = Db::con()->query("SELECT * FROM `tasks` WHERE list_id = '$id_list' ORDER BY id DESC");
			while($rows = $res->fetch_assoc()){
				 $arr[$rows["id"]]= $rows["descript"];
			}
			return $arr;
		}
		public function updateList($name_list,$id)
		{
			Db::con()->query("UPDATE `list` SET `title`= '$name_list' WHERE id = '$id'");
			Db::con()->close();
		}
        public function delList($id)
        {
            Db::con()->query("DELETE FROM `list` WHERE id = '$id'");
            Db::con()->query("DELETE FROM `tasks` WHERE list_id = '$id'");
            Db::con()->close();
        }
        public function  addTask($id_list,$val)
        {
            Db::con()->query("INSERT INTO `tasks`(`descript`,`list_id`) VALUES('$val','$id_list')");
            Db::con()->close();
        }
        public function delTask($id_tsk)
        {
            Db::con()->query("DELETE FROM `tasks` WHERE id = '$id_tsk'");
            Db::con()->close();
        }
        public function updateTask($task_nam,$id)
        {
            Db::con()->query("UPDATE `tasks` SET `descript`= '$task_nam' WHERE id = '$id'");
            Db::con()->close();
        }
	}
	
	$db = new Db;
	
	
?>
