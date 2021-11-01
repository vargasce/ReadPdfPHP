<?php

	header('Content-type: application/json; chaset=utf-8');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		try{
			require_once('searchFile.php');		

			$postText = $_POST['text'];  //OBTENEMOS TEXTO A BUSCAR.
			$postFile = $_POST["files"]; //OBTENEMOS ARRAY DE NOMBRE PDF A LEER.
			$path = "../files/";         //PATH DONDE SE ALOJARAN LOS PDF.

			//INSTANCIA DE CLASS
			$searchFile = new SearchFile($path, $postFile, $postText );
			$resultListData = $searchFile->getListPDF();

			echo json_encode($resultListData);

		}catch( Exception $err ){
			echo json_encode("Error : ". $err);
		}finally{
			exit();
		}
	}else{
		echo json_encode( "IS NOT POST METHOD => DATA-JSON EXPECTED { 'text' : valorString, 'files' : ArrayListPDFName }" );
	}

?>
