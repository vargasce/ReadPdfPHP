<?php
	header('Content-type: application/json; chaset=utf-8');
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		try{
			require_once('searchFile.php');		

			$postText = $_POST['text'];
			$postFile = $_POST["files"];
			//$path = '';
			$path = "http://localhost:8080/TestPHP/src/files/";

			$searchFile = new SearchFile($path, $postFile, $postText );

			$relation = $searchFile->getListPDF();

			echo json_encode($relation);

		}catch( Exception $err ){
			echo json_encode("Error : ". $err);
		}finally{
			exit();
		}
	}
?>
