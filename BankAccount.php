<?php

//Define the abstract class Bank Account

 abstract  class BankAccount{

     // Define Constnt

     const  INFO ="Constant in BankAccount class <br><br/>";  //Property never change , u must give a value .must be capital , memory and rerference once
     static  public $stat ="static property string  <br><br/>";  // Variable ,value can change

     //Define the properties
     //protected  $Balance =  0;
     protected  $Balance ;
     public $APR ;
     public $sortCode;
     public $FirstName ;
     public $LastName;
     public $Audit = [];
     protected  $Locked ; // use on cons
     //protected  $Locked =false;

     //Constructor

     public function  __construct($apr , $sort_code ,$first_name,$last_name, $bal=0, $lock= false)
     {
         $this->Balance   =  $bal;
         $this->APR       =  $apr;
         $this->sortCode  =  $sort_code;
         $this->FirstName =  $first_name;
         $this->LastName  =  $last_name;
         $this->Locked    =  $lock;

     }


     //Static Method

     static  public  function stat(){ // We can reference this in memory once, cant override ,
         echo "This is the method static string" . self::INFO .self::$stat;
     }

     /*Define the Method  to Withdaraw*/
     public function  WidthDraw($amount)
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

     //Lock Account
     public function  Lock()
     {
         $this->Locked = true;

         $transDate = new DateTime();
         array_push($this->Audit, ["ACCOUNT  LOCKED ",  $transDate->format('c')]);  //[] sub array


     }

     //Lock Account
     public function  UnLock()
     {
         $this->Locked = false;

         $unlocktransDate = new DateTime();
         array_push($this->Audit, ["ACCOUNT  UNLOCKED ",    $unlocktransDate->format('c')]);  //[] sub array


     }

 }

 // Fetching the some pience of information  in the memory
 /*echo BankAccount::INFO;
 echo BankAccount::$stat;
 echo BankAccount::stat();*/

