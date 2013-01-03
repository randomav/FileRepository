<?
class File {
	private $loginowner,$name,$comment,$size,$loadtime,$fileid;
	public function __construct($name='',$comment='',$size=0,$loadtime='',$loginowner=''){
	   $this->changeData($name,$comment,$size,$loadtime,$loginowner);
    }
	
	public function changeData($name,$comment,$size,$loadtime,$loginowner){
		$this->name=$name;
		$this->comment=$comment;
		$this->size=$size;
		$this->loadtime=$loadtime;
		$this->loginowner=$loginowner;	
	}
  
	public function getFileId(){
		return $this->fileid;
	}
  
	public function getName(){
		return $this->name;
	}
	
	public function getComment(){
		return $this->comment;
	}
	
	public function getSize(){
	  return $this->size;
	}
	
	public function getLoadTime(){
	  return $this->loadtime;
	}
	
	public function getOwner(){
	  return $this->loginowner;
	}
	
	public function setFileId($newfileid){
	  $this->fileid=$newfileid;
	}
	
	public function setName($newname){
	  $this->name=$newname;
	}
	
	public function setComment($newcomment){
	  $this->comment=$newcomment;
	}
	
	public function setSize($newsize){
	  $this->size=$newsize;
	}
	
	public function setLoadTime($newloadtime){
	  $this->loadtime=$newloadtime;
	}
	
	public function setLoginOwner($loginowner){
	  $this->loginowner=$loginowner;
	}
}
?>