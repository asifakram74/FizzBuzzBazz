<?php 
require_once 'zz.class.php';
?>
<html>
	<head>
		<title>Testing ZZ</title>

	</head>
	<body>
		<form name="myform" action="" method="get">
			Starting Value <input type="text" name="starting" value="">  
			Ending Value <input type="text" name="ending" value="">  
			<input type="submit" name="submit" value="Submit">
		</form>
		<?php 
		if(isset($_REQUEST['starting']) && $_REQUEST['starting']!=="" && isset($_REQUEST['ending']) && $_REQUEST['ending']!=="")
		{
			$zz = new zz($_REQUEST['starting'], $_REQUEST['ending']);
			$zz->output();			
		}			
		?>
	
	</body>
</html>