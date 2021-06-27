<?php
include "config.php";
// $select_user=mysqli_query($con,"SELECT * FROM user_details WHERE user_id='$_SESSION[user_id]'");
// $user_data= mysqli_fetch_assoc($select_user);
 $user_id=$_SESSION['user_id'];
 $account_no=$_SESSION['account_no'];

//exit(); 
// Check user login or not
if(!isset($_SESSION['uname'])){
    $success = "Message successfully sent";
    header('Location: index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');
}
?>
<!doctype html>
<html>
    <head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
    <body>
        <h1>ABC Bank</h1>
       
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="transaction_details.php">Transaction Details <span class="sr-only">(current)</span></a>
      </li>
     
    </ul>
    
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
      <form method='post' action="">
            <input type="submit" value="Logout" name="but_logout">
        </form>
    
  </div>
</nav>
       
<br/>
<table>
  <tr>
  <th>Account Number</th>
  <th>Account Balance</th>
    <th>Money Transfer</th>
    
  </tr>
  <tr>
  <td><?php echo $account_no ?></td>
    <td><button type="button" class="acc_balance btn btn-primary" data-id="<?php echo $account_no ?>">check Balance</button></td>
    <td><a type="button" href="money_transfer.php" class="send_money btn btn-primary">send Money</a></td>
    
  </tr>

</table>
<div id="message"><?php if(isset($success)){ echo 'successs'; } ?></div>
<script src="js/jquery-3.3.1.min.js"></script>  
<script>
    

$(document).ready(function(){


  $(document).on("click",".acc_balance",function(){
 // var r=confirm("Are u sure");   
 // if(r==true)                                         
 // {             

  var del=$(this);
  var id1=$(this).attr("data-id");


  var person = {
            account_number: id1
        }               
 
  $.ajax({
     url:"balance.php",
     type: 'post',
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(person),
      success: function (data) {
          alert("Available Balance="+data)
      },
      error: function(response) {
                  console.log(response);
      }
      
        });
 // }                                  
  });  });

</script>
     


    </body>
</html>