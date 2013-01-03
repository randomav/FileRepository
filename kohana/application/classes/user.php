<?
define('SAVE_USER_OK',0);
define('SAVE_USER_EXIST',1);
define('LOGIN_USER_OK',0);
define('LOGIN_USER_FAIL',1);

class User{
    private $login,$password,$name,$gender,$age;
	//public function __construct(){	}
	
	public function __construct($login='',$password='',$name='',$gender='',$age=0){
	  $this->changeData($login,$password,$name,$gender,$age);
	}
	
	public static function save($user){
	   $bduser = Model::factory('users')->get_users($user->login,'',0);
	   if(empty($bduser)){
		 Model::factory('users')->add_user($user->login, $user->password,$user->name,$user->gender,$user->age);
	     return SAVE_USER_OK;
	   } else return SAVE_USER_EXIST;
	}
	
	public static function login($user,$username,$userpass){
	  $dbuser = Model::factory('users')->get_users($username,$userpass,1);
	  if(!empty($dbuser)){ 
	  $user->changeData($dbuser['Login'],$dbuser['Password'],$dbuser['Name'],$dbuser['Gender'],$dbuser['Age']);
	  
	  return LOGIN_USER_OK;
	  }else return LOGIN_USER_FAIL;
	}
	
	public static function delete($user){
	  return DB::delete('Users')->execute(); // 1-ничего не удалено, 2-1 запись удалена, 3-2записи и т.д.
	  Model::factory('users')->delete_users();
	}
	
	public function changeData($login,$password,$name,$gender,$age){
	  $this->login=$login;
	  $this->password=$password;
	  $this->name=$name;
	  $this->gender=$gender;
	  $this->age=$age;
	}
	
	public function getLogin(){
	  return $this->login;
	}
	
	public function getPassword(){
	  return $this->password;
	}
	
	public function getName(){
	  return $this->name;
	}
	
	public function getGender(){
	  return $this->gender;
	}
	
	public function getAge(){
	  return $this->age;
	}
	
	public function setPassword($newpassword){
	  $this->password=$newpassword;
	}
	
	public function setName($newname){
	  $this->name=$newname;
	}
	
	public function setGender($newgender){
	  $this->gender=$newgender;
	}
	
	public function setAge($newage){
	  $this->age=$newage;
	}
}
?>