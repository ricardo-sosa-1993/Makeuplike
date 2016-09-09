<?php
	function conectarse(){
		if(!($link=mysqli_connect("db616965751.db.1and1.com","dbo616965751","umt8-fme", "db616965751"))){
			echo "Error conectando con la base de datos";
			exit();
		}
		mysqli_set_charset ( $link , "utf8" );
		return $link;
	}
?>