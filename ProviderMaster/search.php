<?php

//grab DB
include '../init.php';




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
				$data = $connection->query("SELECT * FROM ProviderMaster ORDER BY LastName, FirstName  ASC " );
			} else if($search[first] == '*'){
				if($search[last] != "")
					$data = $connection->query("SELECT * FROM ProviderMaster WHERE LastName = '$search[last]' " );
				else
					$data = $connection->query("SELECT * FROM ProviderMaster ORDER BY LastName, FirstName  ASC " );
			} else if($search[last] == '*') {
				if($search[first] != "")
					$data = $connection->query("SELECT * FROM ProviderMaster WHERE  FirstName = '$search[first]'  ");
				else	
					$data = $connection->query("SELECT * FROM ProviderMaster ORDER BY LastName, FirstName  ASC " );
			} else if($search[first] == ""){
				if($search[last] != "")
					$data = $connection->query("SELECT * FROM ProviderMaster WHERE LastName = '$search[last]' " );
				else
					$data = $connection->query("SELECT * FROM ProviderMaster ORDER BY LastName, FirstName  ASC " ); 
			} else if($search[first] == ""){
				if($search[last] != "")
					$data = $connection->query("SELECT * FROM ProviderMaster WHERE LastName = '$search[last]' " );
				else
					$data = $connection->query("SELECT * FROM ProviderMaster ORDER BY LastName, FirstName  ASC " );
			}else{
				$data = $connection->query("SELECT * FROM ProviderMaster WHERE  FirstName = '$search[first]' AND LastName = '$search[last]'   ") ;
			}
		}
		else {
		$data = $connection->query("SELECT * FROM ProviderMaster") or die(mysql_error()); 
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
	


// SEARCH FUNCTIONS TO CHOOSE THE SQL STATMENT


if($search[first] == '*' || $search[first] == '' ) { $first = ""; } else { $first = $search[first]; }
if($search[last] == '*' || $search[last] == '' ) { $last = ""; } else { $last = $search[last]; }

$sql = "SELECT * FROM ProviderMaster WHERE FirstName like  '%$first%' AND LastName like '%$last%' ORDER BY LastName, FirstName ASC";



$query = $connection->query( $sql );
        
$data = $query->fetch();


// Add variable to search for discipline ID and output description        
$discip = "SELECT * FROM DisciplineMaster";

$query2 = $connection->query($discip);

$d = $query2->fetch();


if( $data == null) {

	echo "No results found.";

} else {
	//end php to start table
	//save f and l for onclick
	

	

	
?>


	
	<!--<style> #page:hover {cursor: pointer; text-decoration: underline; }</style>-->
	
	
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
	
	
	
	
	<tr><th>ID</th> <th>Name</th> <th>Discipline</th> <th>Email</th> <th>Location</th></tr>
		
	<tbody>
	
	<?php
	// insert forloop to cycle through the query
	foreach($connection->query($sql) as $row) {  //inserting the statement here 
	
		$tr++;
		$id = $row['ProviderID'];
		$firstname = $row['FirstName'];
		$lastname = $row['LastName'];
		
		print "<tr ";
		if($tr % 2 == 0){  // alternating the colors of the table rows
			echo "class='highlight'";
		}
		print "id='hover' onclick='editform(" . $row['ProviderID'] .", \"" . $row['FirstName'] . " \",  \"" . $row['LastName'] . " \")'>";
		print "<td>" . $row['ProviderID'] . "</td>";
		print "<td>";
		print $row['LastName'] . " " . $row['FirstName'] . "</td>";
		print "<td>"; // change row data to foreach statement to retrieve description instead of ID - cy
			foreach($connection->query($discip) as $d) { 
				
				if( $d['DisciplineID'] == $row['DisciplineID'] ){  
				echo $d['Description'] . "<br/>";
				}
			}				 		
		print "</td>";
		print "<td>Phone: " . $row['Phone'] . "<br/>Fax: " .
		$row['Fax'] . "<br/>Email: " .
		$row['Email'] . "</td>";
		
		/* alternate display for address column - cy 9/30/15
		print "<td>" . $row['Address1'] . "<br/>" . $row['Address2'] . "<br/>" . $row['Address3'] . "<br/>" . $row['Address4'] . "</td>";
		print "<td>" . $row['City'] . "</td>";
		print "<td>" . $row['State'] . "</td>";
		print "<td>" . $row['Zip'] . "</td>";
		print "<td>" . $row['County'] . "</td>";
		print "<td>" . $row['Country'] . "</td>";
		*/
		
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
	<!-- close Table -->
	</tbody>
	<tfoot></tfoot>
	</table>
	
<?php
	
	
} // end the if data==null 





$connection = null;	 // close the db

?>