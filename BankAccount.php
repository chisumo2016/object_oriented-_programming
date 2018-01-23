<?php

//Define the abstract class Bank Account

 abstract  class BankAccount{
     //Define the properties
     protected  $balance =  0;
     public $APR ;
     public $sortCode;
     public $FirstName ;
     public $LastName;
     public $Audit = [];
     protected  $Locked =false;

     //Define the Method  to Withdara

     public function  Widthdraw($amount)
     {
         //define the date
         $transDate = new DateTime();
         if($this->Locked ===  false){
             $this->Balance -= $amount;

             //Insert
             array_push($this->Audit, ["WITHDRAW ACCEPTED ", $amount, $this->Balance, $transDate->format('c')]);  //[] sub array
         }else{

             array_push($this->Audit, ["WITHDRAW DENIED ", $amount, $this->Balance, $transDate->format('c')]);  //[] sub array

         }
     }






 }

