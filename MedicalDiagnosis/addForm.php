<div id='col2'>

<br/>

<p>Enter the name of the Diagnosis.</p>

<input type='text' id='description' style='width: 200px; margin: 20px;' onkeydown="if (event.keyCode == 13) document.getElementById('btnAddCheck').click()"/> 
<br/> 

<input type='button' name='add_button'  Value='Add Diagnosis'  id='btnAddCheck' onclick='checkDiagnosis()' /> 
<input type='button' onclick='search()' value='Go back' />
</div>