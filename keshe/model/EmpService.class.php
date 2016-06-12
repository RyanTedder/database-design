<?php
require_once 'SqlHelper.class.php';

class EmpService{

function updateEmp($id,$name,$grade,$email,$salary)
	{
$sql="update emp set name='$name',grade=$grade,email='$email',salary='$salary'  where id=$id";
$sqlHelper=new SqlHelper();
$res=$sqlHelper->execute_dml($sql);
$sqlHelper->close_connect();
return $res;
}

//根据id来获取一个雇员的信息
function getEmpById($id){
$sql="select * from emp where id=$id";
$sqlHelper=new SqlHelper();
$arr=$sqlHelper->execute_dql2($sql);
$sqlHelper->close_connect();
//二次封装
//$emp=new Emp();
//$emp->setId($arr[0]['id']);
//$emp->setName($arr[0]['name']);
//$emp->setGrade($arr[0]['grade']);
//$emp->setEmail($arr[0]['email']);
//$emp->setSalary($arr[0]['salary']);
return  $arr;

}
//一个函数可以获取共有多少页
function getPageCount($pageSize)
{
	//需要查询$rowCount;
	$sql="select count(id) from emp";
	$sqlHelper=new SqlHelper();
	$res=$sqlHelper->execute_dql($sql);
    //计算$pageCount
	if($row=mysql_fetch_row($res))
	{
		$pageCount=ceil($row[0]/$pageSize);
	}
	mysql_free_result($res);
	$sqlHelper->close_connect();
	return $pageCount;
}
//显示雇员信息
function getEmpListByPage($pageNow,$pageSize)
	{
$sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";
$sqlHelper=new SqlHelper();
$res=$sqlHelper->execute_dql2($sql);
$sqlHelper->close_connect();
	return $res;
}
//分页函数
function getFenyePage($fenyePage)
	{
	$sqlHelper=new SqlHelper();
	$b=$fenyePage->pageSize;
	$a=($fenyePage->pageNow-1)*$b;
	$sql1="select * from emp limit $a,$b";
	$sql2="select count(id) from emp";
	$sqlHelper->execute_dql_fenye($sql1,$sql2,$fenyePage);
$sqlHelper->close_connect();
}

//根据ID删除用户
function delEmpById($id)
	{
$sql="delete from emp where id=$id";
$sqlHelper=new SqlHelper();
$res=$sqlHelper->execute_dml($sql);
return $res;
	}

//根据id修改用户
function chaEmpById($id){
	$sql="";
	$sqlHelper=new SqlHelper();
$res=$sqlHelper->execute_dml($sql);
  $sqlHelper->close_connect();
return $res;
}

//根据用户提供的数据增加新用户
function addEmp($name,$grade,$email,$salary)
	{
	$sql="insert into emp(name,grade,email,salary) values('$name',$grade,'$email',$salary)";
	$sqlHelper=new SqlHelper();
	$res=$sqlHelper->execute_dml($sql);
    $sqlHelper->close_connect();
	return $res;
	}
}
?>