<?php

  include('PdfToText.phpclass');    //LIBRERIA LECTURA DE PDF
  include('./Error/errorFile.php'); //EXCEPTION CUSTOM SEARCHFILE

  class SearchFile
  {

    private $files;
    private $verbose;
    private $path;
    private $list = array();

    /** CONSTRUCTOR
     * @access public
     * @param string $path carpeta en el server donde esten los pdf.
     * @param array $files Array con la lista de PDF a realizar la lectura.
     * @param string $verbose palabras claves para detectar en los archivos.
     */
    public function __construct( $path, $files, $verbose ){
      $this->files = $files;
      $this->verbose = $verbose;
      $this->path = $path;
    }

    /** GET LIST PDF
     * @access public
     * @returns array $this->list retorna lista de coincidencia dentro de la busqueda sobre los pdf.
     */
    public function getListPDF(){

      try{

        for ($i = 0; $i < count( $this->files ); $i++) {

          $fileAux = $this->files[$i];                    //AUX NAME FILE SEARCH
          $pdf = new PdfToText("$this->path$fileAux");
          $data = $pdf->Text;                             //GET STRING FILE PDF
          $data = strtolower($data);                      //CONVERT TO LOWER CASE
          $this->verbose = strtolower( $this->verbose );  //CONVERT TO LOWER CASE

          if( ( $value = strpos( $data, $this->verbose)) !== false ){ //DETECT POS INDEX STRING
            array_push($this->list,$this->files[$i] .' > POSITION : '. $value . ' > VALOR BUSCADO : ' . $this->verbose);
          }

        }
        
        return $this->list ;

      }catch( Exception $error ){
        throw new ExceptionFile('Error in files, class searchFile() $error ' );
      }

    }

  }

?>
