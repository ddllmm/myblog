<?php
	namespace app\admin\controller;
	use think\Controller;
	use think\Db;
	use app\admin\model\User;
	use app\admin\model\Data;
	use app\admin\model\Admin;
	class Index extends Controller{   		
		public function login(){			//登陆方法
			return $this->fetch("login");			
		}
		
		public function check(){					//login的check方法，写入登陆时间、admin状态为在线				
			if($_POST["admin"]=="root" && $_POST["pwd"]=="root"){   
				$date=Date('y/m/d');
				Db::table('admin')
    				->where('id', 1)
    				->update(['status' => '1',
    							      'date'=>$date, 
    								]);
				$this->success("Sign_in Backstage success !",'Index');   
			}
			else{
				Db::table('admin')
    				->where('id', 1)  
    				->update(['status' => '0']);
				echo"<script>alert('用户名或密码错误！');history.back();</script>";
			}	    							
		}
		
		public function index(){			//index方法
			$result=Db::table("admin")->where("id","1")->value("status");
			if($result == "1"){
			$this->assign('index',"index");
			return $this->fetch("index");		
			}
			else{
				return $this->redirect("admin/index/login");
			}					
		}
		
		public function home(){					 	//显示group为home的数据
		 	$list = Db::table("data")->where("group","home")->select();	
			$this->assign('list',$list);	
			$this->assign('home',"active");							
			return $this->fetch("common");			
		}		
		
		public function javascript(){							//显示javascript的数据								    
		    $list = Db::table("data")->where("group","javascript")->select();	
			$this->assign('list',$list);
			$this->assign('javascript',"active");		    	   	    
			return $this->fetch("common");					
		}
								
		public function php(){						//显示php的数据
			$list = Db::table("data")->where("group","php")->select();	
			$this->assign('list',$list);
			$this->assign('php',"active");
			return $this->fetch("common");
		}				
		
		public function mysql(){                     //显示mysql的数据
		   $list = Db::table("data")->where("group","mysql")->select();	
			$this->assign('list',$list);
			$this->assign('mysql',"active");
			return $this->fetch("common");
		}
		
		public function other(){						//显示other的数据
			$list = Db::table("data")->where("group","other")->select();	
			$this->assign('list',$list);
			$this->assign('other',"active");
			return $this->fetch("common");
		}
		
		public function about(){                   //显示about的数据
			$list = Db::table("data")->where("group","about")->select();	
			$this->assign('list',$list);
			$this->assign('about',"active");								
			return $this->fetch("common");
		}
		
		public function create(){                  //create方法生成create页面
			return $this->fetch("create");
		}
		
		public function created(){                  //验证id是否唯一，向数据库添加create的数据
			$id=$_POST["id"];
			$result=Db::table("data")->where("id",$id)->select();
			if($result == NULL){
			Db::table('data')
    			->data(['id'=>$_POST["id"],
    						'group'=>$_POST["group"],
    						'header'=>$_POST["header"],
    						'context'=>$_POST["context"],
    						'detail'=>$_POST["detail"],
    						'auther'=>$_POST["auther"],
    						'status'=>"1",
    						'createtime'=>Date('y/m/d'),
    						])
   				->insert();
   				$this->success("create success !",'Index');   }
   				else{
   					echo"<script>alert('此id已被占用！');history.back();</script>";      
   				}
			
		}
		
		public function edit(){			              //edit数据
			$list = Db::table("data")->where("id",$_POST['edit_id'])->select();	
			$this->assign('list',$list);
			return $this->fetch("edit");	
		}
		
		public function cancel(){                    //取消的跳转方法
			return $this->redirect("admin/index/index");
		}
		
		public function update(){		            //edit完了之后更新数据库
		Db::table('data')
    			->where('id',$_POST["id"])
    			->update([
    						'header'=>$_POST["header"],
    						'context'=>$_POST["context"],
    						'detail'=>$_POST["detail"],
    						]);
    		$this->success("update success !",'Index');   
		}
				
		public function forbid(){                        //forbid方法
			Db::table('data')
    			->where('id',$_POST["forbid_id"])
    			->update([
    						'status'=>'0',
    							]);
			$this->success("forbid success !",'Index');   
		}

		public function delete(){                         //delete方法
			Db::table('data')->where('id',$_POST["delete_id"])->delete();
			$this->success("delete success !",'Index');   
		}	
	}
?>		

	







