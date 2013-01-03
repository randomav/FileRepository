<?
class SuperUser extends User {
    private $logintime;
    public function __construct($login='',$password='',$name='',$gender='',$age=0,$logintime=''){
	  parent::changeData($login,$password,$name,$gender,$age);
	  $this->logintime=$logintime;
    }
}
?>