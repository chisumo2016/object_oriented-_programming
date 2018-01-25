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
 $Account1->Lock();
 $Account1->WidthDraw(200);
 $Account1->UnLock();
 array_push($Account1->Audit, array("WITHDRAW ACCEPTED ", 200,  800,   "2018-04-30T14:28:33+00:00"));  //[] sub array
 $Account1->WidthDraw( 159); //
 //echo  json_encode($Account1, JSON_PRETTY_PRINT);

/*==================== END OF ISA ACCOUNT=======================*/

//Saving Account
$Account2 = new Savings;
$Account2->APR = 12.0;
$Account2->sortCode  = "20-10-89";
$Account2->FirstName  = "Tuma";
$Account2->LastName   = "Joseph";
$Account2->Package   = "Cartoon  Insurance";


$Account2->Deposit(500);
$Account2->Lock();
$Account2->WidthDraw(200);
$Account2->UnLock();
$Account2->WidthDraw( 159); //

//Method from Saving Account
//$Account2->AddedBonus();
$Account2->OrderNewBook();
$Account2->OrderNewDepositBook();

/*==================== END OF SAVINGS ACCOUNT=======================*/

//Debit Account
$Account3 = new Debit;
$Account3->APR = 0;
$Account3->sortCode  = "20-10-89";
$Account3->FirstName  = "Bertha";
$Account3->LastName   = "Joseph3";
$Account3->Package   = "Spy  Insurance";


$Account3->Deposit(15000);
$Account3->Lock();
$Account3->WidthDraw(1200);
$Account3->UnLock();
$Account3->WidthDraw( 159); //

//Method from Saving Account
//$Account3->AddedBonus();
$Account3->ChangePin(1234);
$Account3->Validate();

/*==================== END OF DEBIT  ACCOUNT=======================*/

//Using Interface at Runtime

$AccountList = [$Account1, $Account2,$Account3];
//Iterate through array
foreach ($AccountList as $Account)  // foreach ($AccountList as $Account=$Account1 )
{

    $print =  $Account->FirstName;   //  $print =  $Account->"BOSS Laddy JUUU";

    //Check an Interface and u can use multiple interface
    if($Account instanceof  AccountPlus ){ // check if it has a contract    $Account instanceof  AccountPlus &&  $Account instanceof  Savers
        //$Account->AddedBonus();
        $print .= " AddedBonus()";
    }
    if($Account instanceof  Savers){
        $print .= " AddedBonus() | OrderNewDepositBook()";
    }
    echo $print ."<br/>";    //  echo $print  . "BOSS Laddy JUUU";
}

//echo  json_encode($Account3, JSON_PRETTY_PRINT);



  //Serialize
  //echo serialize($Account1);

   //Json
  //echo  json_encode($Account1);


