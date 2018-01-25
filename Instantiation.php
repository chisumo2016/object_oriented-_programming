<?php
// Subclass
  require ("Subclass.php");

  $Account1 = new ISA;
  $Account1->APR = 50;
  $Account1->sortCode  = "50-50-89";
  $Account1->FirstName  = "David";
  $Account1->LastName   = "Junguna";
  $Account1->AdditionalService   = "holiday package";

 $Account1->Deposit(1000);
 $Account1->WidthDraw(200);
 $Account1->WidthDraw( 159); // will
 echo  json_encode($Account1, JSON_PRETTY_PRINT);



  //Serialize
  //echo serialize($Account1);

   //Json
  //echo  json_encode($Account1);




/* public $Audit = [];*/

