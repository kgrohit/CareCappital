<div id='header'>

	<a href="http://www.thesaigroup.org/wp-admin/TeleSystem/">
	 <img src='http://www.thesaigroup.org/wp-admin/TeleSystem/images/care-cappital-logo.png'
		 /> 
	</a>
	<br/>
	<!--<div style="text-align: right ; float:right; position: relative; bottom: -50px;" > 
		<a href='http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/' >Provider</a> |
		<a href='http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/' >Staff</a> |
		<a href='http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/' >Caregiver</a> | 
		<a href='http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/' >Client</a> | 
		<a href='http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/' >Discipline</a> | 
		<a href='http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/' >Diagnosis</a> 
	</div>-->
	<?php
		
		echo date("F j, Y");
		
	?>
	
	<!-- 
		This is the nav bar outline 
		The nav tags start it, then the ul tags
		list items display links normally.
		To get a drop down efftect, place an ul inside a li
		Then put the dropdown li items in the ul
		close the li
	-->
	<nav>
		<ul> 
			
			<li><a>Registration</a>
				<ul>
					<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/ClientMaster/">Client</a></li>
					<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/StaffMaster/">Staff</a></li>
					<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/CaregiverMaster/">Caregiver</a></li>
					<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/ProviderMaster/">Provider</a></li>
					<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/DisciplineMaster/">Discipline</a></li>
					<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/MedicalDiagnosis/">Diagnosis</a></li>
				</ul>
			</li>
			<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/CMS/">CMS</a></li>
			<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/Account/accountForm.php">Account</a></li>
			<li><a href="http://www.thesaigroup.org/wp-admin/TeleSystem/">Home</a></li>
		</ul>
	</nav>
</div>