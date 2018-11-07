<?php

//grab DB
include '../init.php';



// Search form with Json method

$search = json_decode($_POST['json'],true);


/*The section to display pages by limits*/

	
	//Page is the current page
	//sets the page to 1 if it wasn't set in the post. (By default, it should be posted tho.
	if(!(isset($search[page]))) {
		$page = 1;
	} else {
		$page = $search[page];
	}
	
	// Rows are how many results are displayed per page.
	// same deal as page
	if(!(isset($search[rows]))) {
		$rows = 25;
	} else {
		$rows = $search[rows];
	}
	
	if($rows != 'all') {
		
		//query function to check how many pages there are.
		if( $search[first] || $search[last]) {
			if( $search[first] == '*' && $search[last] == '*' ) {
				$data = $connection->query("SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC " );
			} else if($search[first] == '*'){
				if($search[last] != "")
					$data = $connection->query("SELECT * FROM CaregiverMaster WHERE LastName = '$search[last]' " );
				else
					$data = $connection->query("SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC " );
			} else if($search[last] == '*') {
				if($search[first] != "")
					$data = $connection->query("SELECT * FROM CaregiverMaster WHERE  FirstName = '$search[first]'  ");
				else	
					$data = $connection->query("SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC " );
			} else if($search[first] == ""){
				if($search[last] != "")
					$data = $connection->query("SELECT * FROM CaregiverMaster WHERE LastName = '$search[last]' " );
				else
					$data = $connection->query("SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC " ); 
			} else if($search[first] == ""){
				if($search[last] != "")
					$data = $connection->query("SELECT * FROM CaregiverMaster WHERE LastName = '$search[last]' " );
				else
					$data = $connection->query("SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC " );
			}else{
				$data = $connection->query("SELECT * FROM CaregiverMaster WHERE  FirstName = '$search[first]' AND LastName = '$search[last]'   ") ;
			}
		}
		else {
		$data = $connection->query("SELECT * FROM CaregiverMaster") or die(mysql_error()); 
		}
		$data->execute();
		
		// getting every value in the table
	 	$totalrows = $data->rowcount();
	 	
	 	//calcing the max number of pages.
	 	$lastpage = ceil($totalrows/$rows);
	 	
	
	 	
	 	//The validation to check if we go out of bounds. 
	 	//NOTE: nothing bad happens if we go over the max limit, the result just displays a null value.
	 	if ($page<= 1) { 
			$page= 1; 
		} elseif ($page > $lastpage ) { 
			$page= $lastpage ; 
		}  
	
		//sets the range of the files we show.
		// the first number is the starting value and the second is how many places after
		$max = 'limit ' .($page-1) * $rows .',' .$rows;
	} else {
	
		$max = null;
	}
	

/*
// SEARCH FUNCTIONS TO CHOOSE THE SQL STATMENT

// double null values = search all
if($search[first] == "" && $search[last] == "" ) {
	$sql = "SELECT * FROM CaregiverMaster ORDER BY LastName $max " ;
}

//1 null 1 not = search for all with the not null.
if($search[first] != "" && $search[last] == "" ) {
	if( $search[first] == '*' ) {
		$sql = "SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC $max" ;
	} else {	
		$sql = "SELECT * FROM CaregiverMaster WHERE FirstName = '$search[first]' ORDER BY LastName, FirstName ASC $max"  ;
	}
}

if($search[first] == "" && $search[last] != "" ) {
	if( $search[last] == "*" ) {
		$sql = "SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC $max" ;
	} else {
		$sql = "SELECT * FROM CaregiverMaster WHERE  LastName = '$search[last]'  ORDER BY LastName, FirstName ASC $max" ;
	}
}


//When both values are given, checks for *. If * it works like the two above. Else, it searches for the exact match.
if($search[first] != "" && $search[last] != "" ) {

	if( $search[first] == '*' && $search[last] == '*' ) {
		$sql = "SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC $max" ;
	} else if($search[first] == '*'){
		if($search[last] != "")
			$sql = "SELECT * FROM CaregiverMaster WHERE LastName = '$search[last]'  ORDER BY LastName, FirstName ASC $max" ;
		else
			$sql = "SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC $max" ;
	} else if($search[last] == '*') {
		if ($search[first] != "")
			$sql = "SELECT * FROM CaregiverMaster WHERE  FirstName = '$search[first]' ORDER BY LastName, FirstName ASC $max" ;
		else
			$sql = "SELECT * FROM CaregiverMaster ORDER BY LastName, FirstName ASC $max" ;
	}  
	else{
		$sql = "SELECT * FROM CaregiverMaster WHERE  FirstName = '$search[first]' AND LastName = '$search[last]'  ORDER BY LastName, FirstName ASC $max" ;
	}
}
*/

if($search[first] == '*' || $search[first] == '' ) { $first = ""; } else { $first = $search[first]; }
if($search[last] == '*' || $search[last] == '' ) { $last = ""; } else { $last = $search[last]; }

$sql = "SELECT * FROM CaregiverMaster WHERE FirstName like  '%$first%' AND LastName like '%$last%' ORDER BY LastName, FirstName ASC";


$query = $connection->query( $sql );
        
$data = $query->fetch();

if( $data == null) {

	echo "No results found.";

} else {
	//end php to start table
	//save f and l for onclick
	
	//print $id; 

	
?>


	
	<style> #page:hover {cursor: pointer; text-decoration: underline; }</style>
	
	
	<div style='float: left;'>
		<input type='hidden' id='lastpage' value="<?php echo $lastpage; ?>" >
		<input type='hidden' id='page' value="<?php echo $page; ?>" >
		
		<input type='button' value='<' onclick='backwards()' style="margin: 0; padding: 0;" />
		<!-- <input type='text' value="<?php echo $page ?>" style='width:50px; text-align: center; margin: 0;' id='page' readonly  > -->
		<?php
		
			for( $i = 1; $i <= $lastpage; $i++ ): ?>
				<span id='page' onclick='setPage(<?php echo $i; ?>)' style=' margin: 0 2px 0 2px;
				<?php
					if($i == $page) { echo "font-weight: bold; color: #2FADE2; "; }
				?>
				'><?php echo $i; ?></span>				
				
			<?php
			endfor;
			
		?>
		<input type='button' value='>' onclick='forwards()'style="margin: 0; padding: 0;" />
	</div>
	<div style='float: right;'>
		<?php echo $totalrows . " results"; ?>
		<select id='rows' onchange='searchForm()' >
			<option <?php if($rows == 3){echo "selected"; } ?> value='3' >3</option>
			<option <?php if($rows == 5){echo "selected"; } ?> value='5' >5</option>
			<option <?php if($rows == 10){echo "selected"; } ?> value='10' >10</option>
			<option <?php if($rows == 25){echo "selected"; } ?> value='25' >25</option>
			<option <?php if($rows == 100){echo "selected"; } ?> value='100' >100</option>
			<option <?php if($rows == 'all'){echo "selected"; } ?> value='all' >All</option>
		</select>
	</div>
	
		
			
	<table id='mytable' class='sortable' >
		
		
		
	<!-- Original method for displaying heading with address - cy 10/6/15

	<thead>
		<tr> <th>ID</th> <th>Name</th> <th>Discipline</th> <th>Email</th> <th>Address</th> 
		<th>City</th> <th>State</th> <th>Zip</th> <th>County</th> <th>Country</th> </tr>
	</thead>
		
	-->
	
	<thead>
	<tr> <th>ID</th> <th>Name</th> <th>Contact</th>  <th>Location</th></tr>
	</thead>
	
	<tbody>
	<?php
	// insert forloop to cycle through the query
	foreach($connection->query($sql) as $row) {  //inserting the statement here
		$tr++;
		
		
		print "<tr ";
		if($tr % 2 == 0){  // alternating the colors of the table rows
			echo "class='highlight'";
		}
		print " id='hover' onClick='editform(" . $row['CaregiverID'] .", \"" . $row['FirstName'] . " \",  \"" . $row['LastName'] . " \")'>";
		print "<td>" . $row['CaregiverID'] . "</td>";
		print "<td>";
		print $row['LastName'] . " " . $row['FirstName'] . "</td>";
		print "<td>Phone: " . $row['Phone'] . "<br/>Fax: " .
		$row['Fax'] . "<br/>Email: " .
		$row['Email'] . "</td>";		
		
	
	
		
	
	print "<td><u>Address</u><br/>";
		
		if($row['Address1'] != '' ){
			print $row['Address1'] . "<br/>";
		} 
		if($row['Address2'] != '' ){
			print $row['Address2'] . "<br/>";
		} 
		if($row['Address3'] != '' ){
			print $row['Address3'] . "<br/>";
		} 
		if($row['Address4'] != '' ){
			print $row['Address4'] . "<br/>";
		} 
		
		
		if($row['City'] != ''){
			print $row['City'] . ", ";
		}
		if($row['State'] != ''){
			print $row['State'] . " ";
		}
		if($row['Zip'] != ''){
			print $row['Zip'] . "<br/>";
		}
		if($row['County'] != ''){
			print $row['County'] . " / ";
		}
		if($row['Country'] != ''){
			print $row['Country'] . ", ";
		}
		print "</td>";
		
		print "</tr>";

	}
	 ?>
	 </tbody>
	<tfoot></tfoot>
	</table>
	
<?php
	
	
} // end the if data==null 






$connection = null;	 // close the db

?>