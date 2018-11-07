function getFirstNames() {
	include "../init.php";
	$names = $connection->query("SELECT FirstName FROM StaffMaster ORDER BY FirstName")-fetchAll();
	
	print_r($names);
}