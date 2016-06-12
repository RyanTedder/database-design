<?php
//这是一个工具类，完成对数据库的操作
class SqlHelper{
public $conn;
public $dbname="kesha";
public $username="root";
public $password="root";
public $host="localhost";
public function __construct(){
	$this->conn=mysql_connect($this->host,$this->username,$this->password);
	if(!$this->conn){
		die("连接失败".mysql_error());
	}
	mysql_select_db($this->dbname,$this->conn);

}
//执行dql语句
public function execute_dql($sql)
	{
	$res=mysql_query($sql,$this->conn) or die(mysql_error());
	return $res;
}
//执行dql语句，但是返回一个数组
public function execute_dql2($sql){
$arr=array();
$res=mysql_query($sql,$this->conn) or die(mysql_error());
$i=0;
//把$res=>$arr
while($row=mysql_fetch_assoc($res))
	{
	$arr[$i++]=$row;
}
//关闭$res结果集
mysql_free_result($res);
return $arr;
}
//执行dml语句
public function execute_dml($sql)
	{
	$b=mysql_query($sql,$this->conn) or die(mysql_error());
	if(!$b)
		{
		return 0;//失败
	}else{
		if(mysql_affected_rows($this->conn)>0)
		{
			return 1;//执行ok
		}else{
			return 2;//没有受到影响
		}
	}
	}

//分页情况的查询
	public function execute_dql_fenye($sql1,$sql2,$fenyePage)
	{
		$res=mysql_query($sql1,$this->conn) or die (mysql_error());
$arr=array();
while($row=mysql_fetch_assoc($res))
		{$arr[]=$row;}
mysql_free_result($res);
$res2=mysql_query($sql2,$this->conn) or die(mysql_error());
if($row=mysql_fetch_row($res2))
		{
	$fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
	$fenyePage->rowCount=$row[0];
}
mysql_free_result($res2);

//把导航信息也封装
//显示上一页和下一页
$navigate="";
if($fenyePage->pageNow>1)
{
$prePage=$fenyePage->pageNow-1;
$navigate="<a href='{$fenyePage->gotoUrl}?pageNow=$prePage'>上一页</a>&nbsp;";
}
if($fenyePage->pageNow<$fenyePage->pageCount)
{
$nextPage=$fenyePage->pageNow+1;
$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$nextPage'>下一页</a>&nbsp;";
}

$page_whole=10;
$begin=floor(($fenyePage->pageNow-1)/$page_whole)*$page_whole+1;
$index=$begin;
//整体10页向前翻
//如果当前page在1-10之间，就没有向前翻动的超链接
$inde=$begin-1;
if($fenyePage->pageNow>$page_whole)
{
$navigate.="&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$inde'>&nbsp;<<</a>";
}
//定$begin 1--->10 floor(($pageNow-1)/10) 0*10+1    11--->20 floor(($pageNow-1)/10) 1*10+1   21--->30 floor(($pageNow-1)/10) 2*10+1

for(;($begin<$index+$page_whole)&&($begin<=$fenyePage->pageCount);$begin++){
$navigate.="&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$begin'>[$begin]</a>";
}

//整体向后翻
$navigate.="&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$begin'>>></a>";
$navigate.="&nbsp; &nbsp; &nbsp;&nbsp;"; 
//显示当前页数和总共多少页
$navigate.="<font color='red'>当前为{$fenyePage->pageNow}页/共有{$fenyePage->pageCount}页</font>";

//把$arr赋值给$fenyePage
$fenyePage->res_array=$arr;
$fenyePage->navigate=$navigate;
	}


	//关闭连接的方法
	public function close_connect()
	{
		if(!empty($this->conn)){
			mysql_close($this->conn);
		}
	}
}

?>