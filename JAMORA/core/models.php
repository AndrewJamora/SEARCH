<?php

function getAllUsers($pdo) {
	$sql = "SELECT * FROM job_data 
			ORDER BY 'name' ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $id) {
	$sql = "SELECT * from job_data WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForAUser($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM job_data WHERE 
			CONCAT('name',email,desired_job,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertNewUser($pdo, $name, $email, $desired_job) {

	$sql = "INSERT INTO job_data
			(
				name,
				email,
				desired_job
			)
			VALUES (?,?,?)
			";

	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$name,  $email, $desired_job])) {
		$response = array("status" => "200", "message" => "User successfully inserted!" );

		}

		else {
			$response = array( "status" => "400", "message" => "Error" );
		}

	return $response;

}

function editUser($pdo, $name, $email, $desired_job, $id) {

	$sql = "UPDATE job_data
				SET name= ?,
				email = ?,
				desired_job = ?
					
				WHERE id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$name, $email, $desired_job, $id]);

	if ($executeQuery) {
		return true;
	}

}


function deleteUser($pdo, $id) {
	$sql = "DELETE FROM job_data
			WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return true;
	}
}









?>