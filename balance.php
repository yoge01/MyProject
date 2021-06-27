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

    
    



    $account_no=$data['account_number'];


    $select_user=mysqli_query($conn,"SELECT * FROM account_details WHERE account_no='$account_no'"); 

    $user_data= mysqli_fetch_assoc($select_user);
    
    $available_balance=$user_data['available_balance'];

    echo $available_balance;
    
    return $available_balance;
    ?>