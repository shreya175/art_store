<?php //session_start();
include("includes/head.php");
include("includes/connection.php");
// define variables to empty values   
$nameErr = $HousenumErr = $StreetErr = $BarangayErr = $municipalErr = $PROVINCEErr = $ZipcodeErr = $mobilenoErr = "";  
$name = $Housenum = $Street = $Barangay = $municipal = $PROVINCE = $Zipcode = $mobileno ="";

function valid($name, $Housenum, $Street, $Barangay, $municipal , $PROVINCE , $Zipcode , $mobileno )
{
    include("functions.php");
    if(!isset($_SESSION['USER_ID']))
	{
      redirect_to("login_form.php");
    }
    $user_id = $_SESSION['USER_ID'];
    $art_id = $_SESSION['art_id'];


     $query_category11="SELECT art_work.user_id
                        FROM art_work,user
                        where art_work.user_id = user.user_id AND
                        art_id = '$art_id'";
     $result_category11 = mysqli_query($conn,$query_category11);

 while($row11=mysqli_fetch_array($result_category11)){
    if($user_id == $row11['user_id']){
      echo "<script type=\"text/javascript\">window.alert('You cant buy your own ArtWork');
	          window.location.href = 'info_art.php?id=$art_id';</script>";
  }
    else{

        }
}

//String Validation  
    if (isset($_POST['username'])) {  
         $nameErr = "Name is required";  
    } else {  
        $username = input_data($_POST['username']);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$username)) {  
                $nameErr = "Only alphabets and white space are allowed";  
            }  
    }
	
//House number Validation  
    if (isset($_POST['House_num'])) {  
            $HousenumErr = "House no is required.";  
    } else {  
            $USER_HOUSE_NUMBER = input_data($_POST['House_num']);  
            // check if mobile no is well-formed  
            if (!preg_match ("/^[0-3]*$/", $USER_HOUSE_NUMBER) ) {  
            $HousenumErr = "Only numeric value is allowed.";  
            }  
        //check mobile no length should not be less and greator than 10  
        if (strlen ($USER_HOUSE_NUMBER) != 3) {  
            $HousenumErr = "House no must contain 3 digits.";  
            }  
    } 
	
//Street String Validation  
    if (isset($_POST['Street'])) {  
         $StreetErr = "Street Name is required";  
    } else {  
        $USER_STREET = input_data($_POST['Street']);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$USER_STREET)) {  
                $StreetErr = "Only alphabets and white space are allowed";  
            }  
    }
//Barangay String Validation  
    if (isset($_POST['Brgy'])) {  
         $BarangayErr = "Barangay Name is required";  
    } else {  
        $USER_BRGY = input_data($_POST['Brgy']);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$USER_BRGY)) {  
                $BarangayErr = "Only alphabets and white space are allowed";  
            }  
    }
//Municipality String Validation  
    if (isset($_POST['municipal'])) {  
         $municipalErr = "municipal Name is required";  
    } else {  
        $USER_MUNICIPAL = input_data($_POST['municipal']);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$USER_MUNICIPAL)) {  
                $municipalErr = "Only alphabets and white space are allowed";  
            }  
    }

//District String Validation  
    if (isset($_POST['province'])) {  
         $PROVINCEErr = "District Name is required";  
    } else {  
        $USER_PROVINCE = input_data($_POST['province']);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$USER_PROVINCE)) {  
                $PROVINCEErr = "Only alphabets and white space are allowed";  
            }  
    }

//Zipcode Number Validation  
    if (isset($_POST['zipcode'])) {  
            $ZipcodeErr = "Zipcode no is required.";  
    } else {  
            $USER_ZIPCODE = input_data($_POST['zipcode']);  
            // check if mobile no is well-formed  
            if (!preg_match ("/^[0-6]*$/", $USER_ZIPCODE) ) {  
            $ZipcodeErr = "Only numeric value is allowed.";  
            }  
        //check mobile no length should not be less and greator than 10  
        if (strlen ($USER_ZIPCODE) != 6) {  
            $ZipcodeErr = "Zipcode no must contain 6 digits.";  
            }  
    }
	
//Number Validation  
    if (isset($_POST['contact'])) {  
            $mobilenoErr = "Mobile no is required.";  
    } else {  
            $USER_CONTACT = input_data($_POST['Contact']);  
            // check if mobile no is well-formed  
            if (!preg_match ("/^[0-9]*$/", $USER_CONTACT) ) {  
            $mobilenoErr = "Only numeric value is allowed.";  
            }  
        //check mobile no length should not be less and greator than 10  
        if (strlen ($USER_CONTACT) != 10) {  
            $mobilenoErr = "Mobile no must contain 10 digits.";  
            }  
    } 
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Shipping</title>

    <style type="text/css">

 #content{
            margin: 70px 0px 0px 50px;
        }

         .head-shipping {
          font-size: 30px;
          font-family: "Yu Gothic UI Light";
          color: rgb( 45, 112, 213 );
          position: absolute;
          left: 70px;
          top: 100;
          width: 215px;
          height: 35px;
          z-index: 19;

          }
        .head-address{
          font-size: 30px;
         font-family: "Yu Gothic UI Light";
          color: rgb( 00, 00, 00 );
          position: absolute;
           left:195px;
          top: 100;
          width: 215px;
          height: 35px;
          z-index: 19;
        }
        .hr{
            position: relative;
            border: 1px solid #2d70d5;
            top: -57px;
            width: 1050px;
            left: -64px;
        }

        .fsize-title{
              margin: 10px 50px 10px 350px;
             font-size: 16px;
            font-weight: bold;
        }

        .fsize{
            position: relative;
            top: -50px;
            left: 330px;
            font-size: 17px;
        }
		.error {
		 color: #FF0001;
	   }

         .textbox{
             border-radius: 5px;
           box-shadow: 1px 1.732px 5px 0px rgb( 55, 52, 52 );
          border: 1px solid steelblue;
          background-color: white;
          position: relative;
          left: 50px;
          top: 0px;
          width: 250px;
          height: 30px;
        }
        
         .fsize-special{
            margin: 10px 30px 10px 375px;
            font-size: 15px;
        }
        

        .inputbar{
            cursor: pointer;
          border-radius: 10px;
           font-family: "Yu Gothic UI";
           color: white;
           font-size: 20px;
           margin-top: -50px;
           margin-bottom: 0px;
           border: 1px solid;
           background-color: #43b353;
           position: relative;
           top:-50px;
           left: 850px;
           width: 200px;
           height: 45px;
        }
        input[type=text],

textarea,
fieldset {
/* required to properly style form
   elements on WebKit based browsers */
  -webkit-appearance: none;


  font-family: inherit;
  font-size: 90%;

  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
input:invalid {
  error: 0 0 5px 1px red;
}

input:focus:invalid {
  outline: none;
}

    </style>
</head>
<body>

<div id="content">
    <form  action = "order-summary.php" method="POST" ><br><br><br><br>
       <p>
         <h2 class="head-shipping">Shipping </h2>
         <h2 class="head-address">Address</h2><br> <hr class="hr" style="border-bottom: 2px solid #2d70d5;">
       </p>
    <!--Values from Database -->

          <p class="fsize">Full Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <input class="textbox" type="text" id ="name" required name="name">
            <span class="error">* <?php echo  $nameErr ?> </span> 
		  <br></p>

          <p class="fsize" >House number: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <input class="textbox" type="text" id="house_num" required name="house_num"> 
		  <span class="error">* <?php echo $HousenumErr  ?> </span>
		  <br></p>

           <p class="fsize" >Street:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		   <input class="textbox" type="text" id="street" required name="street">
            <span class="error">* <?php echo $StreetErr  ?> </span>
		   <br></p>


           <p class="fsize" >District:   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		   <input class="textbox" type="text" id="brgy" required name="brgy">
           <span class="error">* <?php echo $BarangayErr ?> </span>
		   <br></p>

            <p class="fsize" >City/Municipality: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			<input class="textbox" type="text" id="municipal" required name="municipal">
             <span class="error">* <?php  echo $municipalErr ?> </span>
			<br></p>

             <p class="fsize" >State: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			 <input class="textbox" type="text" id="province" required name="province"> 
			 <span class="error">* <?php  echo $PROVINCEErr ?> </span>
			 <br></p>

              <p class="fsize" >Zip Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			  <input class="textbox" type="text" id="zipcode" name="zipcode">
			  <span class="error">* <?php echo $ZipcodeErr  ?> </span>
			  <br></p>

             <p class="fsize" >Area:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select id="area" name="area" class="textbox">
                    <option value="luzon">East/West</option>
                    <option value="visayas">Central</option>
                    <option value="mindanao">North/South</option>
              </select> <br></p>

            <p class="fsize" >Mobile Number:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input class="textbox" type="text" id="contact" required name="contact"> 
			<span class="error">* <?php  $mobilenoErr ?> </span>
			<br><br></p>

            <?php
            if($_SESSION['cat'] == 'Sculpture'){
                echo '<p class="fsize" >Quantity: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			          <input class="textbox" type="text" id="" required name="items"> 
			          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			          Max Amount:  '.$_SESSION['art_stock'].' <br><br><br>  </p>';
            }

            ?>
          <input class = "inputbar"type="submit" name="next" value="Next  &#10097;&#10097;">

  </form>
    </div>
</body>
</html>