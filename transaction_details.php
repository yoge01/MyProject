<?php
include "config.php";
 $select_user=mysqli_query($con,"SELECT * FROM transcation_details");
// $user_data= mysqli_fetch_assoc($select_user);
 $user_id=$_SESSION['user_id'];
 $account_no=$_SESSION['account_no'];

//exit(); 
// Check user login or not
if(!isset($_SESSION['uname'])){
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
<link rel="stylesheet" href="toastr/toastr.min.css">

</head>
    <body>
        <h1>ABC Bank</h1>
        
<br/>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
     
    </ul>
    
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
      <form method='post' action="">
            <input type="submit" value="Logout" name="but_logout">
        </form>
    
  </div>
</nav>




<h2>Transaction Details</h2>
<br>
<br>
<table>
  <tr>
  <th>Account Number</th>
  <th>Transaction flag</th>
    <th>Transaction amount</th>
  </tr>
  <?php foreach($select_user as $x)
					 {
             ?>
  <tr>
 
  <td><?php echo $x['account_no'] ?></td>
    <td><?php echo $x['transaction_flag'] ?></td>
    <td><?php echo $x['transaction_amount'] ?></td>
    
  </tr>
  <?php } ?>

</table>






<script src="js/jquery-3.3.1.min.js"></script>  
<script>
    

$(document).ready(function(){


  $(document).on("click",".submit",function(e){
      e.preventDefault();
  //var r=confirm("Are u sure");   
 // if(r==true)                                         
 // {             
    var a = $("#from_account").val();
    var b = $("#to_account").val();
    var c = $("#amount").val();
//alert(a);

  var person = {
    from_account: a,
    to_account: b,
    amount: c
        }               
 
  $.ajax({
     url:"money_transfer2.php",
     type: 'post',
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(person),
      success: function (data) {
          console.log(data);
         
          success_toast();
          window.setTimeout(function(){location.reload()},2000)
      },
      error: function(response) {
        console.log(response);
      }
      
        });
 // }                                  
  });  });

</script>
<script src="toastr/toastr.min.js"></script>
<script>
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "3000",
  "hideDuration": "5000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
function success_toast()
{
toastr.success("Money transfer successfully");

}
function error_toast()
{
toastr.error("error");
}
</script>



    </body>
</html>