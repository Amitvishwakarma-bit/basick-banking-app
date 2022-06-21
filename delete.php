<?php
    include_once('connection.php');
    $id = $_GET['id'];

    $sql = "DELETE from customers WHERE ID =$id" ;
    $querry = mysqli_query($conn, $sql);

    if($querry){
        echo "<script>alert('record deleted successfully!!');</script>";
        ?>
            <meta http-equiv="refresh" content="0; url = http://localhost/basic%20banking%20app/customers.php" />
        <?php
    }


?>