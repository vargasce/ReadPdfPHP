<?php

	header('Content-type: application/json; chaset=utf-8');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		if ( isset($_POST["text"]) ) {
			
			try{
				require_once('searchFile.php');		

				$postText = $_POST['text'];    					   //OBTENEMOS TEXTO A BUSCAR.
				$path = $_SERVER['DOCUMENT_ROOT'];         //OBTENEMOS PATH RAIZ SERVER.
				$postFile = scandir($path.'/doc/normas/'); //OBTENEMOS ARRAY DE NOMBRE PDF A LEER.
			
				if( $postText != ""){

					//INSTANCIA DE CLASS
					$searchFile = new SearchFile($path, $postFile, $postText );
					$resultListData = $searchFile->getListPDF();

					if( Count( $resultListData ) > 0 ){
						echo json_encode($resultListData);
					}else{
						echo json_encode('No result!!');
					}
			
				}else{
					echo json_encode("");
				}

			}catch( Exception $err ){
				echo json_encode("Error : ". $err);
			}finally{
				exit();
			}

		}else{//END ISSET
			echo json_encode( "DATA IS IMCOMPLETE." );
		}

	}else{//END SERVER POST
		echo json_encode( "IS NOT POST METHOD => DATA-JSON EXPECTED { 'text' : valorString }" );
	}

?>
