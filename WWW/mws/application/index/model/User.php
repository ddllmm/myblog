<?php
	namespace app\index\model;
	use think\Db;
	use think\Model;
	class User extends Model{
		//在子类重写父类的初始化方法initialize();
		protected function initialize(){  
		//继承父类中的initialize()
		parent::initialize();  
		//初始化数据表名称，通常自动获取不需设置
		$this->table = 'user'; 
		//初始化数据表字段信息    
  		 $this->field = $this->db()->getTableInfo('', 'fields');  
   		//初始化数据表字段类型
   		$this->type = $this->db()->getTableInfo('', 'type'); 
   		//初始化数据表主键
  		 $this->pk = $this->db()->getTableInfo('', 'pk');     
  		 }
  		 //校验用户名与密码是否对应
  		 public  function check($username,$password){
  			$info=$this->getByusername($username);
  			if($info!=null){
  				if($info['password']!=$password){
  				return false;  //密码不匹配，返回false
  				}else{
  				return true;
  				}
  			}
  		}
	}
?>