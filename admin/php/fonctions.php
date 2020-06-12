<?php

	function add_image()
	{
		if(isset($_FILES["user_image"]))
		{
			$extension = explode('.', $_FILES['user_image']['name']);
			$new_nom = rand() . '.' . $extension[1];
			$destination = './images/' . $new_nom;
			move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
			return $new_nom;
		}
	}

	function get_nom_image($user_id)
	{
		include('db.php');
		$statement = $db->prepare("SELECT image FROM utilisateurs WHERE id = '$user_id'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			return $row["image"];
		}
	}

	function get_all_infos()
	{
		include('db.php');
		$statement = $db->prepare("SELECT * FROM utilisateurs");
		$statement->execute();
        $result = $statement->fetchAll();
		return $result;
	}
