<?php
    include("connection.php");
    include("insert.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Banking System</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&family=Baloo+Bhaina+2&family=Bree+Serif&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav id="navbar">
            <div id="navElement">
                <img id="logo" src="./images/bank.png" alt="bankImg">
                <span id="logoText">MYBANK</span>
            </div>
            <ul id="navigation">
                <li><a href="index.php">Home </a></li>
                <li><a href="customers.php">Customers </a></li>
                <li><a href="transfer_money.php">Transfer Money</a></li>
                <li><a href="#">Transaction History</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <div class="container">
            <form action="" method="post" id="form" onsubmit="return validateForm()">
                <div class="row">
                    <div class="col-25">
                        <label for="name">Name :</label>
                    </div>
                    <div class="col-75">
                        <input type="text" placeholder="Enter your name" id="name" name="name" autocomplete="off"> 
                        <span id="names" class="formerror"></span> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email :</label>
                    </div>
                    <div class="col-75">
                        <input type="text" placeholder="Enter email here" id="email" name="email" autocomplete="off">  
                        <span id="emails" class="formerror"></span> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="amount">Amount :</label>
                    </div>
                    <div class="col-75">
                        <input type="number" placeholder="Enter total amount" name="amount" id="amount" autocomplete="off">  
                        <span id="amounts" class="formerror"></span> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="number">Mobile No. :</label>
                    </div>
                    <div class="col-75">
                        <input type="number" placeholder="Enter mobile number here" id="number" name="number" autocomplete="off">  
                        <span id="numbers" class="formerror"></span> 
                    </div>
                </div>
                <div class="row" >
                    <div class="col-25">
                        <label for="gender">Gender :</label>
                    </div>
                    <div class="col-75" id="genderElements">
                        <input type="radio" class="gender" value="Male" id="male" name="gender">Male 
                        <input type="radio" class="gender" value="Female" id="female" name="gender">Female
                        <input type="radio"class="gender"  value="Other" id="other" name="gender">Other
                        <span id="genders" class="formerror"></span> 
                    </div>
                </div>
                <div class="row">
                    <button type="submit" id="btn" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        function clearError(){
            error = document.getElementsByClassName('formerror');
            for (let item of error) {
                item.innerHTML = "";
            }
            
        }

        function displayError(id,msg){
            document.getElementById(id).innerHTML = msg;
        }

        function validateForm(){
            clearError();

            var name = document.getElementById('name').value;

            if(name == ""){
                displayError("names","**please enter valid name!!");
                return false;
            }
            if(name.length<3){
                displayError("names","**name should be more than 2 characters!!");
                return false;
            }
            var email = document.getElementById("email").value;
            if(email == ""){
                displayError("emails","**please enter your email!!");
                return false;
            }
            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if(email.match(validRegex)){
                clearError();
                
            }else{
                displayError("emails","**please provide valid email!!");
                return false;
            }
            var amount = document.getElementById("amount").value;
            if(amount == ""){
                displayError("amounts","**please enter amount!!")
                return false;
            }
            var number = document.getElementById("number").value;
            if(number == ""){
                displayError("numbers","**please enter your phone number!!");
                return false;
            }
            if(number.charAt(0)!=9 && number.charAt(0)!=8 && number.charAt(0)!=7){
                displayError("numbers","**please provide valid number!!");
                return false;
            }
            if(number.length!=10){
                displayError("numbers","**please provide valid number!!");
                return false;
            }
            var male = document.getElementById("male").checked;
            var female = document.getElementById("female").checked;
            var other = document.getElementById("other").checked;
            if(male == false && female == false && other==false){
                displayError("genders","**please select your gender!!");
                return false;
            }
        }
    </script>
</body>
</html>