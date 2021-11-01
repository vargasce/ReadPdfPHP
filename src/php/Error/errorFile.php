
<?php
  
  /** EXCEPTION CUSTOM
   * @Observations > Exception custom error read files.
   */
  class ExceptionFile extends Exception
  {
      public function __construct($message, $code = 0, Throwable $previous = null) {
      
          parent::__construct($message, $code, $previous);
      }

      //LA VISIBILIDAD DE LA EXCEPTION
      public function __toString() {
          return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
      }

      public function customFunction() {
          echo "No APLICADO\n";
      }
  }

?>
