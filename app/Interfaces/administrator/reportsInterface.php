<?php


namespace App\Interfaces\administrator;


interface reportsInterface
{
 public  function  getDeposits($from,$to);

 public function getWithdrawals($from,$to);

 public function getInvestments($from,$to);


}
