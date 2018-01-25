<?php
require ("BankAccount.php");

class ISA extends BankAccount {
    //public $TimePeriod = 28;
    //private $TimePeriod = 28;
    private $TimePeriod ;  // Bse of constructor
    public $AdditionalService;

    //Constructor

    public function __construct($time, $service, $apr , $sort_code ,$first_name, $last_name, $bal=0, $lock= false)  // can receive vakue and receive arg
    {
        $this->TimePeriod = $time;
        $this->AdditionalService  = $service;

        //Calling Parent class
        parent::__construct($apr , $sort_code ,$first_name,$last_name, $bal, $lock);
    }

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

        echo parent::$stat;
    }


    public function  Penalty()
    {

        $transDate = new DateTime();
        $this->Balance -= 10;
        array_push($this->Audit,array("WITHDRAW PENALTY", 10, $this->Balance,$transDate->format('c')));

    }


}

trait   SavingPlus{
    private $MonthlyFee =20;

    public $Package = "holiday insurance";

    //Methods
    public function  AddedBonus()
    {
        echo "Hello" . $this->FirstName. " " .$this->LastName ." for &pound;" .$this->MonthlyFee ."a month you get " .$this->Package;
    }


}

interface  AccountPlus{
     public function AddedBonus();
}

interface  Savers{  // Must be public
    public function OrderNewBook();
    public function OrderNewDepositBook();

}


class  Savings extends  BankAccount implements  AccountPlus , Savers {
    use SavingPlus;
    public $PocketBook = [];
    public $DepositBook = [];

    // Constructor

    public  function  __construct($free , $package, $apr , $sort_code ,$first_name, $last_name, $bal=0, $lock= false)
    {
        $this->MonthlyFee = $free;
        $this->Package = $package;

        //Calling Parent class
        parent::__construct($apr , $sort_code ,$first_name,$last_name, $bal, $lock);
    }

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


class Debit extends  BankAccount   implements AccountPlus
{

    use SavingPlus;

    //Properties
    private $CardNumber;
    private $SecurityCode;
    private $PinNumber;

    //Constructor

    public function  __construct($fee, $package, $pin, $apr , $sort_code ,$first_name, $last_name, $bal=0, $lock= false)
    {
        $this->MonthlyFee = $fee;
        $this->Package = $package;
        $this->PinNumber = $pin;
        $this->Validate();

        //Calling Parent class
        parent::__construct($apr , $sort_code ,$first_name,$last_name, $bal, $lock);

    }

    //Methods
   private function Validate()    ///public function Validate()
    {
        $valDate = new DateTime();
        $this->CardNumber = rand(1000, 9999) . "-" . rand(1000, 9999) . "-" . rand(1000, 9999) . "-" . rand(1000, 9999);
        $this->SecurityCode = rand(100, 999);
        array_push($this->Audit, array("VALIDATE CARD ", $valDate->format('c'), $this->CardNumber, $this->SecurityCode, $this->PinNumber));

    }

    public function ChangePin($newPin)
    {
        $pinChange = new DateTime(); // security and fraud purpose
        $this->PinNumber = $newPin;  // You can add validate pin number

        array_push($this->Audit, array("PIN CHANGED", $pinChange->format('c'), $this->PinNumber));
    }




}












