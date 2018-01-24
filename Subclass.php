<?php
require ("BankAccount.php");

class ISA extends BankAccount {
    public $TimePeriod = 28;
    public $AdditionalService;

    //Method

    public function  WithDraw($amount){  //Withdraw - Override ,has same name on parent calss
        $transDate = new DateTime(); //
        $lastTransaction = null ; // Contain the number
        $length = count($this->Audit); //how element are in array
        for($i = $length; $i > 0 ; $i--){
            $element  = $this->Audit[$i-1 ]; // contained sub array 3-1 botton to up
            if ($element[0] === "WITHDRAW ACCEPTED"){  // Latest Transaction [0] will look the first array
                $days = new DateTime( $element[3]);
                $lastTransaction= $days->diff($transDate)->format('%a');
                break;  // break /stop the for loop
            }
        }

        if($lastTransaction == null && $this->Locked === false || $this->Locked == false && $lastTransaction >$this->TimePeriod){
            $this->Balance -= $amount;
            array_push($this->Audit,array("WITHDRAW ACCEPTED", $amount, $this->Balance,$transDate->format('c')));
        }else{
                  //Account is not locked
            if ($this->Locked === false){
                $this->Balance -= $amount;
                array_push($this->Audit,array("WITHDRAW ACCEPTED WITH PENALTY", $amount, $this->Balance,$transDate->format('c')));
                $this->penalty();

            }else{
                array_push($this->Audit,array("WITHDRAW DENIED", $amount, $this->Balance,$transDate->format('c')));
            }
        }
    }

    public function  Penalty()
    {

        $transDate = new DateTime();
        $this->Balance -= 10;
        array_push($this->Audit,array("WITHDRAW PENALTY", 10, $this->Balance,$transDate->format('c')));

    }

}

class  Savings extends  BankAccount{
    public $PocketBook = [];
    public $DepositBook = [];

    //Methods

    public function  OrderNewBook(){
        $orderTime = new DateTime();
        array_push($this->PocketBook ,array("Ordered new pocket book on :" . $orderTime->format('c')));
    }

    public function  OrderNewDepositBook(){
        $orderTime = new DateTime();
        array_push($this->PocketBook ,array("Ordered new deposit book on :" . $orderTime->format('c')));
    }
}