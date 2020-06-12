<?php
include('db.php');
include('fonctions.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM utilisateurs
		WHERE id = '".$_POST["user_id"]."'
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["nom"] = $row["nom"];
		$output["prenom"] = $row["prenom"];
		$output["email"] = $row["email"];
		$output["contact"] = $row["contact"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="images/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
