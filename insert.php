<?php
    include_once 'connection.php';

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $amount = $_POST['amount'];
        $number = $_POST['number'];
        $gender = $_POST['gender'];
        
        $sql = "INSERT INTO `customers` (`Name`,`Email`,`Amount`,`Number`,`Gender`) VALUES ('$name','$email','$amount','$number','$gender')";
        
        if(mysqli_query($conn,$sql)){
            echo "<script>alert('data inserted succesfully');</script>";
            ?>
                <meta http-equiv="refresh" content="0; url = http://localhost/basic%20banking%20app/customers.php" />
            <?php 
            // echo "<script>document.location = 'index.php';</script>";
            // header("Location: index.php");
        }else{
            echo "error". mysqli_error($conn);
        }
        // header("Location: index.php");
        mysqli_close($conn);
    }
?>