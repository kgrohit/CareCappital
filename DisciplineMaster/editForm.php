<?php



//get the db
include '../init.php';



//save the id
$id = $_POST['id'];

$query = $connection->query("SELECT * FROM DisciplineMaster WHERE DisciplineID= '$id' ");
        
$data = $query->fetch();
?>

<div id='col2'>

<br/>

<p>Edit the Discipline.</p>

<input type='hidden' id='discID' value="<?php echo $data['DisciplineID']; ?>" > 
<input 
	type='text' 
	id='description' 
	style='width: 200px; margin: 20px;' 
	onkeydown="if (event.keyCode == 13) document.getElementById('btnEditDesc').click()"
	value="<?php echo $data['Description']; ?>" > 
<br/>

<input type='button' onClick='editDiscipline()' Value='Edit'  id='btnEditDesc'> 

<?php if($_SESSION['user']['Role'] === 'admin2'): ?>
<input type='button' onclick='deleteDiscipline(<?php echo $id; ?>)' value='Delete' >
<?php endif; ?>
<input type='button' onclick='search()' value='Go back' >
</div>