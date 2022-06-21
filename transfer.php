<?php
include_once('connection.php');

$id = $_GET['id'];
$sql = "SELECT * FROM customers WHERE ID = $id ";
$querry = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($querry);

// getting all users data


if (isset($_POST['Transfer'])) 
{
    $from = $id;
    $to = $_POST['user'];

    $sender_amount = $result['Amount'];
    $amount_transfer = $_POST['amount'];

    $new_sql = "SELECT * FROM customers WHERE ID= $to ";
    $newQuerry = mysqli_query($conn,$new_sql);
    $result_row = mysqli_fetch_assoc($newQuerry);
    
    $receiver_amount = $result_row['Amount'];

    if($amount_transfer>$sender_amount){
        echo "<script>alert('sorry, transfer amount exceeds minimum amount!!')</script>";
        ?>
             <meta http-equiv="refresh" content="0; url = http://localhost/basic%20banking%20app/transfer_money.php" />
        <?php
    }else{
        $sender_amount = $sender_amount - $amount_transfer;
        $receiver_amount = $receiver_amount + $amount_transfer;

        $querry_s = "UPDATE customers SET Amount = '$sender_amount' WHERE ID = $from";
        mysqli_query($conn,$querry_s);
        
        $querry_r = "UPDATE customers SET Amount = '$receiver_amount' WHERE ID = $to";
        mysqli_query($conn,$querry_r);

        if($querry_s && $querry_r){
            echo "<script>alert('Money Transfered successfully!!');</script>";
            ?>
             <meta http-equiv="refresh" content="0; url = http://localhost/basic%20banking%20app/transfer_money.php" />
        <?php
        }

    }
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>transfer</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            margin: 50px auto;
            background-color: white;
        }

        .table {
            overflow-x: auto;
        }

        table {
            overflow-x: auto;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: #838080;
        }

        h2 {
            text-align: center;
            margin: 40px auto;
            font-size: 2.5rem;
        }

        .rows {
            align-items: center;
            margin: 30px auto;
            padding: 5px;
        }

        .rows>div {
            margin: 5px auto;
        }

        .rows label {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .rows select {
            width: 100%;
            padding: 10px;
            font-size: 1.1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .rows input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 1.1rem;
            border-radius: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }

        .rows button {
            padding: 10px;
            border-radius: 5px;
            font-family: sans-serif;
            font-size: 1.1rem;
            color: white;
            border: none;
            cursor: pointer;
            width: 15%;
            background-color: green;
        }

        .rows button:hover {
            opacity: 0.8;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <form action="" method="POST">
                <div class="table">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Number</th>
                            <th>Gender</th>
                        </tr>
                        <tr>
                            <td><?php echo $result['ID']; ?></td>
                            <td><?php echo $result['Name']; ?></td>
                            <td><?php echo $result['Email']; ?></td>
                            <td><?php echo $result['Amount']; ?></td>
                            <td><?php echo $result['Number']; ?></td>
                            <td><?php echo $result['Gender']; ?></td>
                        </tr>
                    </table>
                </div>
                <h2>Transfer Money</h2>
                <div id="content">
                    <div class="rows">
                        <div>
                            <label class="labels" for="customers">Transfer to :</label>
                        </div>
                        <select name="user" required>
                            <option value="" disabled selected>select values</option>
                            <?php
                            $sql1 = "SELECT * FROM customers WHERE ID!= $id";
                            $querry1 = mysqli_query($conn, $sql1);
                            while ($rows = mysqli_fetch_assoc($querry1)) {
                            ?>
                                <option value="<?php echo $rows['ID']; ?>">

                                    <?php echo $rows['Name'];?> (Amount:
                                    <?php echo $rows['Amount'];?>)

                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="rows">
                        <div>
                            <label class="labels" for="amount">Amount :</label>
                        </div>
                        <input type="number" name="amount" placeholder="enter amount here">
                    </div>
                    <div class="rows">
                        <button name="Transfer" value="Transfer">Transfer</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>