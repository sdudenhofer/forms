<?php
if(!isset($_COOKIE['pyxisrequest_id'])){
    $session_id = $_COOKIE['pyxisrequest_id'];
    
}
?>
<head>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="style.css">
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="datepicker1.js"></script>
	<script src="datepicker2.js"></script>

</head>

<body>
	<title>Pyxis Access Request</title>
	<div id="navbar"><h2>Pyxis Request Form</h2>
	<!--<button type="submit" name="btn-logout" class="btn btn-block btn-primary" style="width:100px; margin-left:25px; margin-top:25px;">Log Out</button></form><h1 style="text-align:center">Pyxis Access Request</h1></div>-->
	<br><br><br>
	<form action ="pyxis.php" method="post" class="form-group form-container" id="submit_form" style="margin-left: 25px">
	<h4>Name: <input class="form-control" type="text" name="name" size="50"> <br><br>
	Email Address: <input class="form-control"type="text" name="email" size="50"> <br><br>
	Department: <select class="form-control" name="department">
	<option value="Admissions Nurse">Admissions Nurse</option>
	<option value="ACM">ACM</option>
	<option value="cardiology">Cardiology</option>
	<option value="CVU">CVU</option>
	<option value="CVOR">CVOR</option>
	<option value="diagnostic imaging">Diagnostic Imaging</option>
	<option value="dialysis">Dialysis</option>
	<option value="emergency room">Emergency Room</option>
	<option value="endo">Endoscopy</option>
	<option value="ICU">ICU</option>
	<option value="OR">OR</option>
	<option value="PACU">PACU</option>
	<option value="SCU">SCU</option>
	<option value="SSU">SSU</option>
	<option value="WHBC">WHBC</option>
	<option value="Wound Care">Wound Care</option></select><br><br>
	Managers Name: <input class="form-control" type="text" name="manager" size="50"><br><br>
	<div id="access" style="border:1px solid #000000; width:33%; padding: 15px; background:green">
	Select Access: <select class="form-control" name="access"><option value="Add">Add Access</option><option value="Remove">Remove Access</option></select><br><br>
	Select Departments to Add or Remove Access:<br><br>
	<input type="checkbox"  name="departmentaccess[]" value="ACM"> ACM <br>
	<input type="checkbox" name="departmentaccess[]" value="Cath Lab"> Cath Lab <br>
	<input type="checkbox" name="departmentaccess[]" value="CVOR"> CVOR <br>
	<input type="checkbox" name="departmentaccess[]" value="CVU"> CVU <br>
	<input type="checkbox" name="departmentaccess[]" value="Endo"> Endoscopy <br>
	<input type="checkbox" name="departmentaccess[]" value="ER"> ER <br>
	<input type="checkbox" name="departmentaccess[]" value="ICU"> ICU <br>
	<input type="checkbox" name="departmentaccess[]" value="OR"> OR <br>
	<input type="checkbox" name="departmentaccess[]" value="PACU"> PACU <br>
	<input type="checkbox" name="departmentaccess[]" value="DI"> Diagnostic Imaging <br>
	<input type="checkbox" name="departmentaccess[]" value="SCU"> SCU <br>
	<input type="checkbox" name="departmentaccess[]" value="SSU"> SSU <br>
	<input type="checkbox" name="departmentaccess[]" value="WHBC"> WHBC <br>
	<input type="checkbox" name="departmentaccess[]" value="Wound Care"> Wound Care <br>
	<input type="checkbox" name="departmentaccess[]" value="Nuc Med"> Nuclear Medicine <br>
	<input type="checkbox" name="departmentaccess[]" value="CDU"> CDU <br>
	<input type="checkbox" name="departmentaccess[]" value="RT">RT<br><br />
	Effective Date: <input class="form-control" type="text" id="datepicker" name="startdate" size="15"><br><br>
	Expire Date: <input class="form-control" type="text" id="datepicker2" name="enddate" size="15"><br><br>
	Duration: <select class="form-control" name="duration"><option value="Permanent">Permanent</option><option value="Temporary">Temporary</option></select> 
	</div><br><br>
	Access Level:<select class="form-control"name="accesslevel"><option value="Student Nurse">Student Nurse</option>
	<option value="Nurse">Nurse</option>
	<option value="Super User">Super User</option>
	<option value="NM/PCC/HC">Nurse Manager/PCC/House Coordinator </option>
	</select><br><br>
	<input type="submit" value="Submit" class="btn btn-primary">
	</form>
	
	<Br><br>

</body>