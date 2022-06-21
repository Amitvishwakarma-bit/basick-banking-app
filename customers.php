<?php
    include_once('connection.php');
    $sql = " SELECT * FROM customers ";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer details</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        #navbar{
            background-color: #423e3e;;
            overflow: auto;
            border-radius: 20px;
            font-weight: bold;
        }
        #navbar div{
            display: flex;
            font-size: 1.1rem;
            float: left;
            margin: 5px;
            padding: 5px;
            color: white;
        }
        #navbar div img{
            width: 30px;
            height: 30px;
            border-radius: 15px;
        }
        #navbar div span{
            margin: 4px;
            padding: 4px;
        }
        #navbar ul{
            display: flex;
            float: right;
            margin-right: 25px;
        }
        #navbar ul li{
            font-size: 1.1rem;
            padding: 0px 10px;
            list-style: none;
            overflow: auto;
            cursor: pointer;

        }
        #navbar ul li a{
            text-decoration: none;
            color: white;
        }
        #navbar ul li a:hover{
            opacity: 0.8;
        }
        section{
            width: 80%;
            margin: 20px auto;
            background-color: white;
        }
        h2{
            text-transform: uppercase;
            text-align: center;
        }
        h2 span{
            font-family: sans-serif;
            background-color: #f2f2f2;
            color: black;
            font-weight: bolder;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }
        th, td {
            border: 2px solid #423e3e;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even){
            background-color: #f2f2f2
        }
        .update, .delete{
            margin: 2px;
            padding: 5px;
            border-radius: 5px;
            font-family: sans-serif;
            font-size: 1.1rem;
            color: white;
            border: none;
            cursor: pointer;
            width: 45%;
        }
        input[type="button"]:hover{
            opacity: 0.7;
        }
        .update{
            background-color: #007bff;
            
        }
        .delete{
            background-color: red;
        }
        
    </style>
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
                <li><a href="history.php">Transaction History</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h2><span>customers details</span></h2>
        <table>
            <tr>
                <th width="7%">ID</th>
                <th width="15%">Name</th>
                <th width="30%">Email</th>
                <th width="10%">Amount</th>
                <th width="10%">Number</th>
                <th width="8%">Gender</th>
                <th width="20%">Operations</th>
            </tr>
            <?php 
                while( $rows = $result->fetch_assoc())
                {
                    echo 
                        "<tr>
                            <td>".$rows['ID']."</td>
                            <td>".$rows['Name']."</td>
                            <td>".$rows['Email']."</td>
                            <td>".$rows['Amount']."</td>
                            <td>".$rows['Number']."</td>
                            <td>".$rows['Gender']."</td>
                            <td>
                            <a href='update_details.php?id=$rows[ID]'><input type='button' class='update' value='update'></a>
                            <a href='delete.php?id=$rows[ID]'><input type='button' class='delete' onclick='return checkDelete()' value='delete'></a>
                            </td>
                        </tr>";
                }
            ?>
        </table>
    </section>
    <script>
        function checkDelete(){
            return confirm("are you sure want to delete this record?"); 
        }
    </script>
</body>
</html>
