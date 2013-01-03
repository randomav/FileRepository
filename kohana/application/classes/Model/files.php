<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Files extends Kohana_Model
{
	public function get_files($loginowner=null,$fileid=null){
		return ($loginowner===null) ? DB::select()->from('Files')->where('FileId','=',$fileid)->execute()->as_array():DB::select()->from('Files')->where('Owner','=',$loginowner)->execute()->as_array();
	}
	
	public function save_file($FileId,$Name, $Comment, $Owner, $LoadTime,$Size){
		return DB::insert('Files')->values(array($FileId,$Name, $Comment, $Owner, $LoadTime,$Size))->execute();
	}
	
	public function delete_file($FileId){
		return DB::delete('Files')->where('FileId','=',$FileId)->execute();
	}
}