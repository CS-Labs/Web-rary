 <?php
$servername = "chester.cs.unm.edu";
$username = "jclark8";
$password = "Xht0ZRe9";
$db = "jclark8";
ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // echo "Connected successfully";
    }
catch(PDOException $e)
    {
   		echo "Connection failed: " . $e->getMessage();
    }
?> 
