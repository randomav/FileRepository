<?
define('LOAD_FILES_OK',0);
define('LOAD_FILES_EMPTY',1);

class FileList {
	private $Files,$Count;
	public function __construct($loginowner=''){
	   if(!empty($loginowner)){$this->loadFiles($loginowner);}
    }
	
	public function loadFiles($loginowner=''){
		$dbfiles = Model::factory('files')->get_files($loginowner);
		if(!empty($dbfiles)){
		//print_r($dbfiles);
		$this->Count=count($dbfiles);
		$this->Files=array();
		for($i=0;$i<$this->Count;$i++){
		$this->Files[] = new File($dbfiles[$i]["Name"],$dbfiles[$i]["Comment"],$dbfiles[$i]["Size"],$dbfiles[$i]["LoadDate"],$dbfiles[$i]["Owner"]);
		$this->Files[$i]->setFileId($dbfiles[$i]["FileId"]);
		}
		return LOAD_FILES_OK;
		} else return LOAD_FILES_EMPTY;
	}
	
	public function SaveFiles(){
	    if(!empty($this->Files)){
	    foreach($this->Files as $file)
		$dbfiles = Model::factory('files')->get_files('',$file->getFileId());
		if(empty($dbfiles))
		Model::factory('files')->save_file($file->getFileId(),$file->getName(), $file->getComment(),$file->getOwner(),$file->getLoadTime(),$file->getSize());
        }
	}
	
	public function AddFile($File){
		$this->Files[]=$File;
	}
	
	public function DeleteFile($FileNum){
	    //foreach($this->$Files as $file);
		//if($file->getFileId()==$FileId)unset($this->Files[$file]);
		//echo $this->Files[$FileNum]->getFileId();
		return Model::factory('files')->delete_file($this->Files[$FileNum]->getFileId());
		unset($this->Files[$FileNum]);
	}
	
	public function ChangeFile($File){
	}
	
	public function getFileCount(){
	  return $this->Count;
	}
	
	public function getFiles(){
	  return $this->Files;
	}
}
?>