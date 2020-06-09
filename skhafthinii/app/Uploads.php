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

if(isset($_SESSION['auth']))
{
    if($_SESSION['authType'] != "restaurant")
    {
        header("Location: /index.php?error= this is an annonymous page");
    }
    else
    {
        //getting the inputs

        $foodName =testInput($_POST['food_name']);
        $price = testInput($_POST['cost']);
        $image = $_FILES['image']['name'];

        if(empty($foodName))
        {
            header("Location: ../views/restaurant.blade.php?error=the food name field is empty please dare to fill it up");
        }
        else if(empty($price))
        {
            header("Location: ../views/restaurant.blade.php?error=the price field is empty");
        }
        else if(empty($image))
        {
            header("Location: ../views/restaurant.blade.php?error=the image field id empty");
        }
        else
        {
            //image directory
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            //sending the details to the db
            try
            {
                $stmt = $conn->prepare("INSERT INTO foods (foodname,price,foodImage) VALUES(:foodName,:price,:foodImage)");
                $stmt->bindParam(":foodName",$foodName);
                $stmt->bindParam(":price",$price);
                $stmt->bindParam(":foodImage",$image);
                $rt = $stmt->execute();

                if($rt > 0)
                {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file))
                    {
                        header("Location: ../views/restaurant.blade.php?success");
                    }
                    else
                    {
                        header("Location: ../views/restaurant.blade.php?error=the image failed to upload");
                    }
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
}
else
{
    header("Location: /index.php?error=unauthorised page request please login to access page");
}