<!DOCTYPE HTML>
<html>

<head>
<title>inserimento dati</title>
</head>

<body>
<?php
    $servername = "localhost";
    $username = "ctbappet";
    $password = "aqeB]o8682I[CM";
    $dbname = "ctbappet_wp451";
    $conn=mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
     }

    $XCoord = $_POST['XCoord'];
    $YCoord = $_POST['YCoord'];
    $GRID_ID = $_POST['GRID_ID'];
    $N_ADDRESSES = $_POST['N_ADDRESSES'];
    $SPEED_DOWN = $_POST['SPEED_DOWN'];
    $SPEED_UP = $_POST['SPEED_UPLOAD'];
    $COVERAGE = $_POST['COVERAGE'];
	$TYPE = $_POST['TYPE'];
	$sqlpre = "INSERT INTO grids
			(XCoord, YCoord, GRID_ID, TYPE)
			VALUES
			('$XCoord','$YCoord','$GRID_ID','$TYPE')";
    $sql = "INSERT INTO to_approve
			(XCoord, YCoord, GRID_ID, N_ADDRESSES, SPEED_DOWN, SPEED_UP, COVERAGE, TYPE)
			VALUES
			('$XCoord','$YCoord','$GRID_ID','$N_ADDRESSES','$SPEED_DOWN','$SPEED_UP','$COVERAGE','$TYPE')";
	
    if(mysqli_query($conn,$sql)){
	echo("Inserimento avvenuto correttamente");
    } else{
		if(mysqli_query($conn,$sqlpre)){
			if(mysqli_query($conn,$sql)){
				echo("Inserimento avvenuto correttamente");
			}
			else { 
			echo 'Errore: ' . mysqli_error($conn);
			}
		}
		else { 
		echo 'Errore: ' . mysqli_error($conn);
		}
	}
	mysqli_close($conn);
	header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Content-Type: application/xml; charset=utf-8");
    ?>
</body>
<script type="text/javascript">
  window.location="https://bergamaschi-andrea.netsons.org/geojson.php"; 
</script>
</html>
