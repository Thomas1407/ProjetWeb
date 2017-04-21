<?php
function DbConnection(){
if (isset($databaseConnection)){
	return $databaseConnection;
}
else{
$databaseConnection = new PDO("mysql:host=localhost;dbname=webproject", "root", "");	
return $databaseConnection;
}
}