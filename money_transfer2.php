<?php
    $dbhost='localhost';
    $dbuser='root';
    $dbpass='';
    $dbname='bank';
    $conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    
    if(! $conn ){
    die('could not connect' .mysqli_error());
    }

    $data = json_decode(file_get_contents('php://input'), true);

    $from_account=$data['from_account'];
    $to_account=$data['to_account'];
    $amount=$data['amount'];


    
    $value1="insufficient funds";
    $value2="Success";
    $status="00";
    $status1="11";

    $select_user=mysqli_query($conn,"SELECT * FROM account_details WHERE account_no='$from_account'"); 
    $select_user1=mysqli_query($conn,"SELECT * FROM account_details WHERE account_no='$to_account'"); 

    $user_data= mysqli_fetch_assoc($select_user);
    $user_data1= mysqli_fetch_assoc($select_user1);
    
    $available_balance=$user_data['available_balance'];
    $available_balance1=$user_data1['available_balance'];

    if ($amount <= $available_balance ) {
    $add_amt=$amount+$available_balance1;
    $minus_amt=$available_balance-$amount;
    $insert_user=mysqli_query($conn,"UPDATE account_details SET available_balance='$add_amt' WHERE account_no='$to_account'");
    $insert_user1=mysqli_query($conn,"UPDATE account_details SET available_balance='$minus_amt' WHERE account_no='$from_account'");


    $transcation_details=mysqli_query($conn,"INSERT INTO transcation_details (account_no,transaction_flag,transaction_amount) VALUES ('$from_account','D','$amount')");
    $transcation_details=mysqli_query($conn,"INSERT INTO transcation_details (account_no,transaction_flag,transaction_amount) VALUES ('$to_account','C','$amount')");
     $responseDesc = $value2;
     $responseCode = $status;
     

      }  else {
        $responseDesc = $value1;
        $responseCode = $status1;
      }

$result=array("responseDesc"=>$responseDesc,"responseCode"=>$responseCode); 
echo json_encode($result);   
exit();
    ?>