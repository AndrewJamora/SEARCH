<?php  
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertUserBtn'])) {
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$desired_job = trim($_POST['desired_job']);

	if (!empty($name) && !empty($email) && !empty($desired_job)) {


		$insertQuery = insertNewUser($pdo,$_POST['name'], $_POST['email'], $_POST['desired_job']);

			if ($insertQuery['status'] == '200') {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../index.php");
			}
	}

	else {
		$_SESSION['message'] = "Failed";
		$_SESSION['status'] = "400";
		header("Location: ../index.php");
	}

}

if (isset($_POST['editUserBtn'])) {
	$editUser = editUser($pdo,$_POST['name'], $_POST['email'], $_POST['desired_job'], $_GET['id']);

	if ($editUser) {
		$_SESSION['message'] = "Successfully edited!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteUserBtn'])) {
	$deleteUser = deleteUser($pdo,$_GET['id']);

	if ($deleteUser) {
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}
?>