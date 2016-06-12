<?php
//这个类的一个对象实例代表一条雇员记录
class Emp
{
	private $id;
	private $name;
	private $grade;
	private $email;
	private $salary;
	//get
	public function getId()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->name;
	}

	public function getGrade()
	{
		return $this->grade;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getSalary()
	{
		return $this->salary;
	}
	//set
/*		public function setId()
	{
		return $this->id;
	}

	public function setName()
	{
		return $this->name;
	}

	public function setGrade()
	{
		return $this->grade;
	}
	public function setEmail()
	{
		return $this->email;
	}
	public function setSalary()
	{
		return $this->salary;
	}*/
}
?>