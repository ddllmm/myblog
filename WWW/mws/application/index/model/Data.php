<?php
	namespace app\index\model;
	use think\Model;
	class Data extends Model{	
		//在子类重写父类的初始化方法initialize();
		protected function initialize(){  
		//继承父类中的initialize()
		parent::initialize();  
		//初始化数据表名称，通常自动获取不需设置
		$this->table = 'data'; 
		//初始化数据表字段信息    
  		 $this->field = $this->db()->getTableInfo('', 'fields');  
   		//初始化数据表字段类型
   		$this->type = $this->db()->getTableInfo('', 'type'); 
   		//初始化数据表主键
  		 $this->pk = $this->db()->getTableInfo('', 'pk');     
  		}
  	}
?>