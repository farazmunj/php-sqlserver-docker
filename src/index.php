<?PHP

/* Specify the server and connection string attributes. */  
$serverName = "mssql";  
  
/* Get UID and PWD from application-specific files.  */  
$uid = "sa";  
$pwd = "yourStrong(!)Password";  
$connectionInfo = array( "UID"=>$uid,  
                         "PWD"=>$pwd,  
                         "Database"=>"");  
  
/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  
if( $conn === false )  
{  
     echo "Unable to connect.</br>";  
     die( print_r( sqlsrv_errors(), true));  
}  

/* Query SQL Server for the login of the user accessing the  
database. */  
$tsql = "SELECT CONVERT(varchar(32), SUSER_SNAME())";  
$stmt = sqlsrv_query( $conn, $tsql);  
if( $stmt === false )  
{  
     echo "Error in executing query.</br>";  
     die( print_r( sqlsrv_errors(), true));  
}  
  
/* Retrieve and display the results of the query. */  
$row = sqlsrv_fetch_array($stmt);  
echo "User login: ".$row[0]."</br>";  
echo "<pre>";
print_r($row);
echo "</pre>";

/* Free statement and connection resources. */  
sqlsrv_free_stmt( $stmt);  
sqlsrv_close( $conn);  


// Get UID and PWD from application-specific files.   
try {  
   $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd);   
   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );   
}  

catch( PDOException $e ) {  
   die( "Error connecting to SQL Server" );   
}  

echo "Connected to SQL Server\n";  

# $query = 'select * from Person.ContactType';   
$query = 'SELECT CONVERT(varchar(32), SUSER_SNAME())';   
$stmt = $conn->query( $query );   
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){   
   print_r( $row );   
}  

// Free statement and connection resources.   
$stmt = null;   
$conn = null;   

echo phpinfo();

?>