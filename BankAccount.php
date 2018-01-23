<?php

//Define the abstract class Bank Account

 abstract  class BankAccount{
     //Define the properties
     protected  $Balance =  0;
     public $APR ;
     public $sortCode;
     public $FirstName ;
     public $LastName;
     public $Audit = [];
     protected  $Locked =false;

     /*Define the Method  to Withdaraw*/
     public function  Widthdraw($amount)
     {
         //define the date
         $transDate = new DateTime();
         if($this->Locked ===  false){
             $this->Balance -= $amount;

             //Insert
             array_push($this->Audit, ["WITHDRAW ACCEPTED ", $amount, $this->Balance, $transDate->format('c')]);  //[] sub array
         }else{

             array_push($this->Audit, ["WITHDRAW DENIED ", $amount,  $this->Balance, $transDate->format('c')]);  //[] sub array

         }
     }

     /*Define the Method to Deposit*/
     public function  Deposit($amount)
     {
         //define the date
         $transDate = new DateTime();
         if($this->Locked ===  false){
             $this->Balance += $amount;

             //Insert
             array_push($this->Audit, ["DEPOSIT ACCEPTED ", $amount, $this->Balance, $transDate->format('c')]);  //[] sub array
         }else{

             array_push($this->Audit, ["DEPOSIT DENIED ", $amount, $this->Balance, $transDate->format('c')]);  //[] sub array

         }
     }
     
 }

