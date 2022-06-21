<?php
    include("connection.php");
    $id = $_GET['id'];
    $sql = "SELECT * FROM customers WHERE ID = $id ";
    $querry = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($querry);
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
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        /* form section  */
        .container {
            margin: 0 auto;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            padding: 60px 0px;
            box-sizing: border-box;
        }

        #form {
            width: 40%;
            height: 450px;
            border-radius: 5px;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #423e3e;
            color: white;
            box-shadow: 2px 2px 17px rgb(0 0 0 / 50%)
        }

        .container h2 {
            text-align: center;
            text-transform: uppercase;
        }

        .row {
            margin: 5px;
            padding: 1px;
            overflow: auto;

        }

        .row div>label:nth-child(1) {
            float: left;
            width: 19%;
            margin: 15px;
            font-size: 1.1rem;
            box-sizing: border-box;

        }

        .row input[type="text"],
        input[type="number"] {
            float: right;
            margin-top: 7px;
            margin-right: 7px;
            width: 70%;
            padding: 8px;
            box-sizing: border-box;
            border-radius: 5px;
            font-family: sans-serif;
            font-size: 1rem;
            border: 1px solid #ccc;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #genderElements {
            margin-left: 15px;
        }

        .gender {
            margin: 16px 10px;
        }

        /* button styling */
        #btn {
            margin: 15px;
            padding: 10px;
            width: 23%;
            border-radius: 5px;
            background-color: #4CAF50;
            font-family: sans-serif;
            font-size: 1.1rem;
            color: white;
            border: none;
            cursor: pointer;
        }

        #btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <form action="" method="post" id="form" onsubmit="return validateForm()">
                <h2>Update User Details</h2>
                <div class="row">
                    <div class="col-25">
                        <label for="name">Name :</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="name" value="<?php echo $result['Name']; ?>" name="name" autocomplete="off">
                        <span id="names" class="formerror"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email :</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="email" value="<?php echo $result['Email']; ?>" name="email" autocomplete="off">
                        <span id="emails" class="formerror"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="amount">Amount :</label>
                    </div>
                    <div class="col-75">
                        <input type="number" value="<?php echo $result['Amount']; ?>" name="amount" id="amount" autocomplete="off">
                        <span id="amounts" class="formerror"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="number">Mobile No. :</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="number" value="<?php echo $result['Number']; ?>" name="number" autocomplete="off">
                        <span id="numbers" class="formerror"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="gender">Gender :</label>
                    </div>
                    <div class="col-75" id="genderElements">
                        <input type="radio" class="gender" value="Male" 
                        <?php 
                        if ($result['Gender'] == 'Male') {
                            echo "checked";
                        }
                        ?> id="male" name="gender">Male
                        <input type="radio" class="gender" value="Female" 
                        <?php 
                        if ($result['Gender'] == 'Female') {
                            echo "checked"; } 
                        ?> id="female" name="gender">Female
                        <input type="radio" class="gender" value="Other" 
                        <?php 
                        if ($result['Gender'] == 'Other') {
                             echo "checked";  } 
                        ?> id="other" name="gender">Other
                        <span id="genders" class="formerror"></span>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" id="btn" name="update">Update </button>
                </div>
            </form>
        </div>
    </section>
    <?php 
    include('connection.php');

    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $amount = $_POST['amount'];
        $number = $_POST['number'];
        $gender = $_POST['gender'];

        $sql = "UPDATE customers set Name='$name', Email='$email', Amount='$amount', Number='$number', Gender='$gender' WHERE ID = $id";
        $querry = mysqli_query($conn,$sql);
        if($querry){
            echo "<script>alert('data updated successfully!!');</script>";
            ?>
             <meta http-equiv="refresh" content="0; url = http://localhost/basic%20banking%20app/customers.php" />
            <?php
        }
        mysqli_close($conn);
    }
?>
    <script>
        function clearError() {
            error = document.getElementsByClassName('formerror');
            for (let item of error) {
                item.innerHTML = "";
            }
        }

        function displayError(id, msg) {
            document.getElementById(id).innerHTML = msg;
        }

        function validateForm() {
            clearError();

            var name = document.getElementById('name').value;

            if (name == "") {
                displayError("names", "**please enter valid name!!");
                return false;
            }
            if (name.length < 3) {
                displayError("names", "**name should be more than 2 characters!!");
                return false;
            }
            var email = document.getElementById("email").value;
            if (email == "") {
                displayError("emails", "**please enter your email!!");
                return false;
            }
            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if (email.match(validRegex)) {
                clearError();

            } else {
                displayError("emails", "**please provide valid email!!");
                return false;
            }
            var amount = document.getElementById("amount").value;
            if (amount == "") {
                displayError("amounts", "**please enter amount!!")
                return false;
            }
            var number = document.getElementById("number").value;
            if (number == "") {
                displayError("numbers", "**please enter your phone number!!");
                return false;
            }
            if (number.charAt(0) != 9 && number.charAt(0) != 8 && number.charAt(0) != 7) {
                displayError("numbers", "**please provide valid number!!");
                return false;
            }
            if (number.length != 10) {
                displayError("numbers", "**please provide valid number!!");
                return false;
            }
            var male = document.getElementById("male").checked;
            var female = document.getElementById("female").checked;
            var other = document.getElementById("other").checked;
            if (male == false && female == false && other == false) {
                displayError("genders", "**please select your gender!!");
                return false;
            }
        }
    </script>
</body>

</html>