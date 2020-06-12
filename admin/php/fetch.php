<?php
	include('db.php');
	include('fonctions.php');
	$query = '';
	$output = array();
	$query .= "SELECT * FROM utilisateurs";
	if(isset($_POST["search"]["value"]))
	{
		$query .= 'WHERE nom LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR prenom LIKE "%'.$_POST["search"]["value"].'%" ';
	}
	if(isset($_POST["order"]))
	{
		$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
		$query .= 'ORDER BY id DESC ';
	}
	if($_POST["length"] != -1)
	{
		$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$data = array();
	$filtered_rows = $statement->rowCount();
	foreach($result as $row)
	{
		$image = '';
		if($row["image"] != '')
		{
			$image = '<img src="images/'.$row["image"].'" class="img-thumbnail" width="30" height="30" />';
		}
		else
		{
			$image = '';
		}
		$sub_array = array();
		$sub_array[] = $image;
		$sub_array[] = $row["nom"];
		$sub_array[] = $row["prenom"];
		$sub_array[] = $row["email"];
		$sub_array[] = $row["contact"];
        $sub_array[] = '<a href="#" title="Voir les détails" name="see" id="'.$row["id"].'" class="text-success"><i class="fa fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;';
        $sub_array[] = '<a href="#" title="Voir les détails" name="update" id="'.$row["id"].'" class="text-success"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;';
        $sub_array[] = '<a href="#" title="Voir les détails" name="delete" id="'.$row["id"].'" class="text-success"><i class="fa fa-trash fa-lg"></i></a>&nbsp;&nbsp;';
		$data[] = $sub_array;
	}
	$output = array(
		"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	$filtered_rows,
		"recordsFiltered"	=>	get_all_infos(),
		"data"				=>	$data
    );
    //var_dump($output);exit();
	echo json_encode($output);