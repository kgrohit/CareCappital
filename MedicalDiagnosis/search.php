<?php
	
	//grab DB
	include '../init.php';
	
	

// get the description
$desc = $_POST['desc'];

 
//   $sql = "SELECT * FROM DisciplineMaster ORDER BY DisciplineID ASC";



/*The section to display pages by limits*/
	

	//Page is the current page
	//sets the page to 1 if it wasn't set in the post. (By default, it should be posted tho.
	if(!(isset($_POST['page']))) {
		$page = 1;
	} else {
		$page = $_POST['page'];
	}
	
	// Rows are how many results are displayed per page.
	// same deal as page
	if(!(isset($_POST['rows']))) {
		$rows = 25;
	} else {
		$rows = $_POST['rows'];
	}
	
	if($rows != 'all') {
		
		//query function to check how many pages there are.
		if( $_POST['desc'] ) {
			$data = $connection->query("SELECT * FROM MedicalDiagnosis WHERE Description = '$desc'");
		} else {
			$data = $connection->query("SELECT * FROM MedicalDiagnosis") or die(mysql_error()); 
		}
		$data->execute();
		
		// getting every value in the table
	 	$totalrows = $data->rowcount();
	 	
	 	//calcing the max number of pages.
	 	$lastpage = ceil($totalrows/$rows);
	 	
	
	 	
	 	//The validation to check if we go out of bounds. 
	 	//NOTE: nothing bad happens if we go over the max limit, the result just displays a null value.
	 	if ($page< 1) { 
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
	
	 
	
	





//SEARCH FUNCTIONS TO CHOOSE THE SQL STATMENT

// double null values = search all
if($desc == "" ) {
	$sql = "SELECT * FROM MedicalDiagnosis ORDER BY ICD ASC $max" ;
}

/*
//1 null 1 not = search for all with the not null.
if($first != "" && $last == "" ) {	
	$sql = "SELECT * FROM CaregiverMaster WHERE FirstName = '$first' ORDER BY CaregiverID ASC $max"  ;
}

if($first == "" && $last != "" ) {
	$sql = "SELECT * FROM CaregiverMaster WHERE  LastName = '$last'  ORDER BY CaregiverID ASC $max" ;
}
*/


//When both values are given, checks for *. If * it works like the two above. Else, it searches for the exact match.
if($desc != "" ) {

	if($desc == '*'){
		$sql = "SELECT * FROM MedicalDiagnosis WHERE Description = '$desc'  ORDER BY ICD ASC $max" ;
	
	} else{
		$sql = "SELECT * FROM MedicalDiagnosis WHERE  Description = '$desc' ORDER BY ICD ASC $max" ;
	}
}


$query = $connection->query( $sql );
        
$data = $query->fetch();

		

if( $data == null) {

	echo "No results found.";

} 
else {
	//end php to start table
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
		<select id='rows' onchange='search()' >
			<option <?php if($rows == 3){echo "selected"; } ?> value='3' >3</option>
			<option <?php if($rows == 5){echo "selected"; } ?> value='5' >5</option>
			<option <?php if($rows == 10){echo "selected"; } ?> value='10' >10</option>
			<option <?php if($rows == 25){echo "selected"; } ?> value='25' >25</option>
			<option <?php if($rows == 100){echo "selected"; } ?> value='100' >100</option>
			<option <?php if($rows == 'all'){echo "selected"; } ?> value='all' >All</option>
		</select>
	</div>
	
	
	

	<table id='mytable' class='sortable' >
	<tr> <th>ID</th> <th>Name</th> </tr>




<?php 
// insert forloop to cycle through the query
foreach($connection->query($sql) as $row) : ?> 

	<tbody>	
	<tr
	<?php if($tr % 2 == 0){  // alternating the colors of the table rows
		echo "class='highlight'";
		$tr++;
	}?>
	id='hover' onclick='editForm(<?php echo $row["ICD"]; ?>)' >
	<td width ="10%"><?php echo $row["ICD"]; ?></td> 
	<td><?php echo $row["Description"]; ?></td>
	</tr>
		
<?php endforeach; ?>

	</tbody>
	<tfoot></tfoot>
	</table>

<!-- Alternative method, might not need. cy - 11/2/15	
	<input type='button' value='<' onclick='backwards()' style="margin: 0;" />
	<input type='text' value="<?php echo $page ?>" style='width:50px; text-align: center; margin: 0;' id='page' readonly  >
	<input type='button' value='>' onclick='forwards()'style="margin: 0;" /> 
-->
	
		
<?php

}



	$connection = null;	 // close the db

?>