<?php

 	include('./PdfToText/PdfToText.phpclass');
  include('./Error/errorFile.php');

  class SearchFile
  {

    private $files;
    private $verbose;
    private $path;
    private $list = array();
  
    public function __construct( $path, $files, $verbose ){
      $this->files = $files;
      $this->verbose = $verbose;
      $this->path = $path;
    }

    public function getListPDF(){

      try{

        //for ($i = 1; $i <= $this->files.length; $i++) {
          //$pdf = new PdfToText($this->path . $this->files[$i]);
          //$data = $pdf->Text;
          //if( strpos($this->verbose, $data) ){
            //array_push($list,$this.files[$i]);
          //}
        //}
        $pdf = new PdfToText("../files/ROM.pdf");
        $data = $pdf->Text;

        return $data;

      }catch( Exception $error ){
        throw new ExceptionFile('Error in files, class searchFile()',0 );
      }
     }

  }

?>
