<?php
	$con = mysqli_connect(
		"localhost", /// host
		"", /// Duomenų bazės slapyvardis
		"", /// Duomenų bazės slaptažodis
		"" /// Duomenų bazės lentelės pavadinimas
	);
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>