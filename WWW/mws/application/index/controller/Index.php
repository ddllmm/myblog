<?php
	namespace app\index\controller;
	use think\Controller;
	use think\Db;
	use app\index\model\User;
	use app\index\model\Data;
	class Index extends Controller{   		
		public function home(){					 				
			
		    $this->assign('home',"active");
		    $list = Db::table("data")->where("group","home")->select();	
			$this->assign('list',$list);						
			return $this->fetch("home");			
		}
			
	
		public function javascript(){
			
		    $this->assign('javascript',"active");
		    $list = Db::table("data")->where("group","javascript")->select();	
			$this->assign('list',$list);		    
			return $this->fetch("common");
		}
		
		public function php(){
			
		    $this->assign('php',"active");
		    $list = Db::table("data")->where("group","php")->select();	
			$this->assign('list',$list);		    
			return $this->fetch("common");
		}
		
		public function mysql(){
			$class="mysql";
		    $this->assign('mysql',"active");
		    $list = Db::table("data")->where("group","mysql")->select();	
			$this->assign('list',$list);		    
			return $this->fetch("common");
		}
		
		public function other(){
			
		    $this->assign('other',"active");
		    $list = Db::table("data")->where("group","other")->select();	
			$this->assign('list',$list);		    
			return $this->fetch("common");
		}
		
		public function about(){									
			
		    $this->assign('about',"active");
		    $list = Db::table("data")->where("group","about")->select();	
			$this->assign('list',$list);									
			return $this->fetch("common");
		}				
		
		public function sign_in(){
		
		    $this->assign('class',"active");
			return $this->fetch("sign_in");
		}
		
		public function sign_up(){
			$class="sign_up";
		    $this->assign('class',$class);
			return $this->fetch("sign_up");
		} 
		
		public function search(){
			$searchtext=$_GET["navbartext"];
			echo "$searchtext";
		}
						
		public function detail($id){						
		    $comment = Db::table("comment")->where("did",$id)->select();					   
		    $list = Db::table("data")->where("id",$id)->select();	
			$this->assign('list',$list);
			$this->assign('comment',$comment);			
			return $this->fetch("detail");
		}
		
		/*//Sign_in登录页的用户验证方法 
		public function check(){	
			$user=new User();		
			$result=$user->check($_POST['username'], $_POST['password']);
			if($_POST['username']==""||$_POST['password']==""){
				echo"<script>alert('用户名和密码不能为空！');history.back();</script>";			
			}
			elseif($_POST["username"]=="root"||$_POST["password"]=="root"){      //root用户登陆后台
				
				$date=date('y/m/d');
				$this->success("Sign_in Backstage success !",'admin\Index\Index');   
			}
			elseif($result==true)
	    	{	
	    		/*session_start();
				$arr=array(
				$_SESSION["user"]=$_POST["username"],
				$_SESSION["pwd"]=$_POST["password"]
				//$_SESSION["time"]=date('y/m/d');
				);
				dump($arr);
	    		$this->success("Sign in successed!",'index\index\Home');
	    	}
	    	else{
	    		echo"<script>alert('用户名与密码错误！');history.back();</script>";
	    	}	
		}*/		
	}
?>		

	







