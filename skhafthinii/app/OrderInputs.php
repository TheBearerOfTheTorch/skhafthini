<?php

session_start();
include 'Connection.php';

function testInput($input)
{
    $input = stripslashes($input);
    $input = trim($input);
    $input = htmlspecialchars($input);

    return $input;
}

if(isset($_POST['order']))
{
    //getting th input
    $foodnumber = testInput($_POST['food_number']);
    $paymentType = testInput($_POST['payment']);

    //checking if the field are empty
    if(empty($foodnumber))
    {
        header("Location: ../views/client.blade.php?error=the food number field is empty");
    }
    else if(empty($paymentType))
    {
        header("Location: ../client.blade.php?error=the payment method field is empty");
    }
    else
    {
        //checking if the food number exists
        $stmt = $conn->prepare("SELECT price FROM foods WHERE id=?");
        $stmt->bindValue(1,$foodnumber);
        $stmt->execute();

        if($stmt->rowCount())
        {
            //sending the details to the db
            while($data = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $dbPrice = $data['price'];
                $stmt = $conn->prepare("INSERT INTO orders(foodId,paymentType,orderBy,userType,price) VALUES(:foodId,:paymentType,:orderBy,:userType,:price)");
                $stmt->bindParam(":foodId",$foodnumber);
                $stmt->bindParam(":paymentType",$paymentType);
                $stmt->bindParam(":orderBy",$_SESSION['auth']);
                $stmt->bindParam(":userType",$_SESSION['authType']);
                $stmt->bindParam(":price",$dbPrice);
                $rt = $stmt->execute();

                if($rt > 0)
                {
                    header("Location: ../views/client.blade.php?success");
                }
            }
        }
        else
        {
            header("Location: ../client.blade.php?error=the food number was not found in our record");
        }
    }
}
else if(isset($_POST['delete']))
{
    //checking for the user input
    $foodNum = testInput($_POST['food_number']);

    if(empty($foodNum))
    {
        header("Location: ../views/restaurant.blade.php?error=the food number is empty");
    }
    else
    {
        //checking if the given food number exist
        $stmt = $conn->prepare("SELECT id FROM foods WHERE id=?");
        $stmt->bindValue(1,$foodNum);
        $stmt->execute();

        if($stmt->rowCount())
        {
            //deleting the food from the record
            $stmt = $conn->prepare("DELETE FROM foods WHERE id=?");
            $stmt->bindValue(1,$foodNum);
            $rt = $stmt->execute();

            if($rt > 0)
            {
                header("Location: ../views/restaurant.blade.php?success");
            }
            else
            {
                header("Location: ..views/restaurant.blade.php?error=failed to delete");
            }
        }
        else
        {
            header("Location: ../views/restaurant.blade.php?error=the food number does not exist in our record");
        }
    }
}
else
{
    if(!isset($_SESSION['auth']))
    {
        header("Location: ../index.php?error=unauthorised page request . please log in");
    }
    else
    {
        if($_SESSION['authType'] == "admin")
        {
            header("Location: ../index.php?error=unauthorised to view the requested page");
        }
    }
}