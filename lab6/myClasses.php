<?php
class dbLink
{
	private $conn;
	function __construct($dbnm)
	{
		$lines = file('/home/int322_161a19/secret/topsecret');
		$j=0;
		$host = trim($lines[$j++]);
		$user = trim($lines[$j++]);
		$pass = trim($lines[$j++]);
		$dbnm = trim($dbnm);
		$this->conn = mysqli_connect($host,$user,$pass,$dbnm) or die("Error connecting to SQL: " . mysqli_error($conn));
	}

	function __destruct()
	{
		mysqli_close($this->conn);
	}

	function query($sqlCmd)
	{
		$this->result = mysqli_query($this->conn, $sqlCmd) or die('Query failed: '. mysqli_error($conn));
		return $this->result;
	}
}

class loginData
{
	public $error;
	public $errorMsg;
	public $username;
	public $password;

	public function isValid()
	{
		if(!empty($this->username))
		{
			if(!empty($this->password))
			{
				$this->error = false;
				return true;
			}
			else
			{
				//Empty password
				$this->error = true;
				$this->errorMsg = 'Error: Empty password!';
				return false;
			}
		}
		else
		{
			//Empty username
			$this->error = true;
			$this->errorMsg = 'Error: Empty username!';
			return false;
		}
	}
}
?>