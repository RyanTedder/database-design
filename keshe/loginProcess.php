<?php
require_once 'AdminService.class.php';
//接受用户的数据
$id=$_POST['id'];
$password=$_POST['password'];
$check=$_POST['check'];
session_start();
$checkcode=$_SESSION['checkcode'];
//到数据库去验证
$adminService=new AdminService();
$name=$adminService->checkAdmin($id,$password);
if($name!="")
{
	if($check==$checkcode)
	{   //取出用户名
		header("Location:empManage.php?name=$name");
		exit();
		}
		else{
		header("Location:login.php?errno=2");
	exit();
		}
}else{
	header("Location:login.php?errno=1");
	exit();
}


/* if($id=="root"&&$password=="root")
{
    header("Location:empManage.php");
	exit();
}

else{
		header("Location:login.php?errno=1");
	exit();
} */
?>