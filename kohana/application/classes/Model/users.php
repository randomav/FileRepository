<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Users extends Kohana_Model
{
	public function get_users($login='',$password=null,$returntype=0){
	    //returntype: 0 - возвращает массив, 1- возвращает одну запись
		if($returntype==0) return $password===null ? DB::select()->from('Users')->where('Login','=',$login)->execute()->as_array() : DB::select()->from('Users')->where('Login','=',$login)->and_where('Password','=',$password)->execute()->as_array();
		else if($returntype==1) return $password===null ? DB::select()->from('Users')->where('Login','=',$login)->execute()->current() : DB::select()->from('Users')->where('Login','=',$login)->and_where('Password','=',$password)->execute()->current();
	}
	
	public function add_user($login='',$password='',$name='',$gender='',$age=0){
		return DB::insert('Users')->values(array($login, $password,$name,$gender,$age))->execute();
	}
	
	public function delete_users(){
		return DB::delete('Users')->execute();
	}
}