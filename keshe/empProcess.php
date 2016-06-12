<?php
require_once 'EmpService.class.php';
//接受用户要删除的ID
$empService=new EmpService();

if(!empty($_REQUEST['flag']))
{    $flag=$_REQUEST['flag'];
	$id=$_REQUEST['id'];
	if($flag=="del")
	{
if($empService->delEmpById($id)==1)
		{
	header("Location:ok.php");
	exit();
		}
		else{
			header("Location:error.php");
			exit();
		}
		}
else if($flag=="addemp"){
	$name=$_POST['name'];
    $grade=$_POST['grade'];
	$email=$_POST['email'];
	$salary=$_POST['salary'];
   $res=$empService->addEmp($name,$grade,$email,$salary);
  if($res==1)
	{
	  header("Location:ok.php");
	  exit();
  }
  else{
	  include 'error.php';
	  exit();
  }
}
else if($flag=="updateemp")
	{
	$id=$_POST['id'];
    $name=$_POST['name'];
    $grade=$_POST['grade'];
	$email=$_POST['email'];
	$salary=$_POST['salary'];
 $res=$empService->updateEmp($id,$name,$grade,$email,$salary);
  if($res==1)
	{
	  header("Location:ok.php");
	  exit();
  }
  else{
	  include 'error.php';
	  exit();
  }
}
}

?>