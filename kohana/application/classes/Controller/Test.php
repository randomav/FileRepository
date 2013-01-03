<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {

	public function action_index()
	{
		//$this->response->body('hello, world!');
		//$this->db = Database::instance();
		//$sql='select * from GoodsTable';
		//$this->db->query(Database::SELECT, $sql, FALSE);
		//$result = DB::query(Database::SELECT, $query)->execute();
		
        //$query = DB::select()->from('GoodsTable')->limit(10)->execute()->as_array();
		
		//print_r($query);
		//$bduser = Model::factory('mymodel')->get_users('123','',1);
		$login=null;
		$password=null;
		$Login='';
		$Password='';
		$Name='';
		$Gender='';
		$Age='';
		extract($_REQUEST);
		$session = Session::instance();
		
		$operation=$this->request->query('operation');
		
		if($operation=='registration'){
		    $view = View::factory();
			echo $view->render('registration');
		}
		else if($operation=='adduser'){
		    //$view = View::factory();
			//echo $view->render('registration');
			$validation = Validation::factory($_REQUEST);
			$validation->label('Login', 'Имя пользователя');
			$validation->label('Password', 'Пароль');
			$validation->label('Gender', 'Пол');
			$validation->label('Age', 'Возраст');
			$validation->rules('Login', array(array('not_empty'),array('min_length', array(':value', 3)),array('max_length', array(':value', 20)),));
			$validation->rules('Password', array(array('not_empty'),array('min_length', array(':value', 3)),array('max_length', array(':value', 20)),));
			$validation->rules('Name', array(array('not_empty'),array('min_length', array(':value', 3)),array('max_length', array(':value', 70)),));
			$validation->rule('Gender', 'in_array', array(':value', array('М', 'Ж')));
			$validation->rules('Age', array(array('not_empty'),array('range', array(':value', 0, 200)),));
			$status = $validation->check();
			$errors = $validation->errors('validation');
			foreach($errors as $err)echo $err.'<br>';
			if($status){
			$usr=new User($Login,$Password,$Name,$Gender,$Age);
			$usr->save($usr);
			HTTP::redirect('?operation=authorize');
			} else HTTP::redirect('?operation=registration');
		}
	    else if($operation=='authorize'||!$session->get('authorized')){
			$msg="";	
			//$login=$this->request->query('login');
			//$password=$this->request->query('password');
			$usr = new User();
			if(file_exists('admins.cfg'))
			if($file=file_get_contents('admins.cfg'))list($adminuser, $adminpassword)=explode(" ", $file);
			if($login==$adminuser && $password==$adminpassword){
				$session->set('authorized', true)->set('UserName', $login)->set('UserType', 'admin');
				$files = new FileList($login);
				HTTP::redirect('?operation=showfiles');
			}
			else if($usr->login($usr,$login,$password)==LOGIN_USER_FAIL){
				if($login!==null||$password!==null)$msg="Неправильное имя пользователя или пароль.";
				$view = View::factory()->set('msg',$msg);
				echo $view->render('authorize');
			} 
			else{
					$session->set('authorized', true)->set('UserName', $login)->set('UserType', 'user');
					$files = new FileList($login);
					HTTP::redirect('?operation=showfiles');
					
				}
		}
		
		else if($operation=='exit'){
		    $session->set('authorized', false);
			$session->delete('authorized')->delete('UserName');
			HTTP::redirect('?operation=authorize');
		}
		
		else if($operation=='showfiles'){
			$files = new FileList($session->get('UserName'));
			//echo "файлов:".$files->getFileCount();
			if(!isset($delcount))$delmsg="";
			else $delmsg="Удалено $delcount файлов<br>";
			echo View::factory()->set('files',$files->getFiles())->set('filecount',$files->getFileCount())->set('delmsg',$delmsg)->render('showfiles');
		}
		
		else if($operation=='deleteselected'){
			$files = new FileList($session->get('UserName'));
			$delcount=0;
			for($i=0;$i<$files->getFileCount();$i++){
				$del=$this->request->query($i);
				if(!empty($del)){
					$files->DeleteFile($i);
					$delcount++;
				}
			}
			$files->loadFiles("randomav");
			//echo "Удалено $delcount файлов";
			//request->query('');
			HTTP::redirect("?operation=showfiles&delcount=$delcount")->set('delmsg',"Удалено".$delcount."файлов");
		}
		
		else if($operation=='addfile'){	
			
			if(!empty($_FILES)){
				$uploaded = Upload::save($_FILES['FileName'], $_FILES['FileName']['name'], 'upload');
				$file=new File($_FILES['FileName']['name'],$Comment,$_FILES['FileName']['size'],date("d.m.y H:i:s"),$session->get('UserName'));
				$files = new FileList($session->get('UserName'));
				$files->AddFile($file);
				$files->SaveFiles();
				$view = View::factory()->set('files',$files->getFiles());
				
				HTTP::redirect('?operation=showfiles');
			}else{$view = View::factory();
				echo $view->render('addfile');
				//print_r($_FILES);
				}
			//$uploaded = Upload::save($_FILES['FileName'], 'file', 'upload'); 
			//echo '='.$uploaded;
		}
		//$admin = new SuperUser();
		//echo $usr->getAge();
		//$usr->getAge2($usr);
		//$usr->save($usr);
		//User $usr=new User();
        //$result = $query->execute();	
		//print_r($result);
		//$query = $this->db->query('select current_date() as date');
        //$query->result(false);
        //$row=$query->current();
        //echo $row['date'];
	}

}
