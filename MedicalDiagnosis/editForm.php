<?php



//get the db
include '../init.php';



//save the id
$id = $_POST['id'];

$query = $connection->query("SELECT * FROM MedicalDiagnosis WHERE ICD = '$id' ");
        
$data = $query->fetch();
?>

<div id='col2'>

<br/>

<p>Edit the Discipline.</p>

<input type='hidden' id='icd' value="<?php echo $data['ICD']; ?>" >
<input 
	type='text' 
	id='description' 
	style='width: 200px; margin: 20px;' 
	onkeydown="if (event.keyCode == 13) document.getElementById('btnEditDiag').click()"
	value="<?php echo $data['Description']; ?>" > 
<br/>

<input type='button' onClick='editDiagnosis()' Value='Edit'  id='btnEditDiag'>
<?php if($_SESSION['user']['Role'] === 'admin2'): ?>
<input type='button' onclick='deleteDiagnosis(<?php echo $id; ?>)' value='Delete' >
<?php endif; ?>
<input type='button' onclick='search()' value='Go back' >
</div>