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

//����id����ȡһ����Ա����Ϣ
function getEmpById($id){
$sql="select * from emp where id=$id";
$sqlHelper=new SqlHelper();
$arr=$sqlHelper->execute_dql2($sql);
$sqlHelper->close_connect();
//���η�װ
//$emp=new Emp();
//$emp->setId($arr[0]['id']);
//$emp->setName($arr[0]['name']);
//$emp->setGrade($arr[0]['grade']);
//$emp->setEmail($arr[0]['email']);
//$emp->setSalary($arr[0]['salary']);
return  $arr;

}
//һ���������Ի�ȡ���ж���ҳ
function getPageCount($pageSize)
{
	//��Ҫ��ѯ$rowCount;
	$sql="select count(id) from emp";
	$sqlHelper=new SqlHelper();
	$res=$sqlHelper->execute_dql($sql);
    //����$pageCount
	if($row=mysql_fetch_row($res))
	{
		$pageCount=ceil($row[0]/$pageSize);
	}
	mysql_free_result($res);
	$sqlHelper->close_connect();
	return $pageCount;
}
//��ʾ��Ա��Ϣ
function getEmpListByPage($pageNow,$pageSize)
	{
$sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";
$sqlHelper=new SqlHelper();
$res=$sqlHelper->execute_dql2($sql);
$sqlHelper->close_connect();
	return $res;
}
//��ҳ����
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

//����IDɾ���û�
function delEmpById($id)
	{
$sql="delete from emp where id=$id";
$sqlHelper=new SqlHelper();
$res=$sqlHelper->execute_dml($sql);
return $res;
	}

//����id�޸��û�
function chaEmpById($id){
	$sql="";
	$sqlHelper=new SqlHelper();
$res=$sqlHelper->execute_dml($sql);
  $sqlHelper->close_connect();
return $res;
}

//�����û��ṩ�������������û�
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