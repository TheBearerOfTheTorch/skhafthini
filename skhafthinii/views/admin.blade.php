<?php
    session_start();
    //checking if the session is set
    if(isset($_SESSION['auth']))
    {
        if($_SESSION['authType'] != "admin")
        {
            header("Location: /index.php?error=unauthorised page request");
        }
        else
        {
            //end of the first cut
            ?>
            <!DOCTYPE html>
            <html lang="en" >
            <html>
                <head>
                    <title>Admin control panel</title>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">   
                    <style>
                        ul li{}
                        ul li a {color:black;}
                        ul li a:hover {color:black; font-weight:bold;}
                        ul li {list-style:none;}

                        ul li a:hover{text-decoration:none;}
                        #social-fb,#social-tw,#social-gp,#social-em{color:blue;}
                        #social-fb:hover{color:#4267B2;}
                        #social-tw:hover{color:#1DA1F2;}
                        #social-gp:hover{color:#D0463B;}
                        #social-em:hover{color:#D0463B;}
                    </style>
                </head>
                <body>
                    <!-- navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
                        <a class="navbar-brand" href="index.php"><span style="margin-left:90px;color:green;font-family: 'Permanent Marker', cursive;">Sk’hafthini</span></a>
                        
                        <a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user">Admin</i></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                        <div class="collapse navbar-collapse" style="margin-left:1000px;color:black; text-decoratio:none;" id="navbarResponsive">
                            <a class="nav-link" href="../app/Logout.php">
                                <ul class="navbar-nav ml-auto">
                                    <button class="btn btn-outline-success">Log Out</button>
                                </ul>
                            </a>
                        </div>
                    </nav>
                    <!--navbar ends-->

                    <!--details section-->
                    <div class="container" style="margin-top:60px;">
                        <!--tab heading-->
                        <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" style="color:#BDDEFD;" id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem" aria-selected="true">View Food Items</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  style="color:#BDDEFD;" id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="false">View registered</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color:#BDDEFD;" id="orderstatus-tab" data-toggle="tab" href="#orderstatus" role="tab" aria-controls="orderstatus" aria-selected="false">Order status</a>
                            </li>
                        </ul>

                        <!--tab 1 starts-->   
                        <div class="tab-content" id="myTabContent">
                            <?php
                                //database connection
                                $servername = '127.0.0.1';
                                $dbname = 'skhafthini';
                                $username = 'root';
                                $pass = "";
                                try
                                {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$pass);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                                    $stmt = $conn->prepare("SELECT * FROM foods");
                                    $stmt->execute();

                                    if($stmt->rowCount())
                                    {
                                        while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $id = $data['id'];
                                            $foodname = $data['foodname'];
                                            $price = $data['price'];
                                            $date = $data['updated_at'];
                            ?>
                            <div class="tab-pane fade show active" style="margin-top:50px;" id="viewitem" role="tabpanel" aria-labelledby="viewitem-tab">
                                <div class="container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Food name</th>
                                                <th scope="col">Food id</th>
                                                <th scope="col">price</th>
                                                <th scope="col">updated at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $id;?></td>
                                                <td><?php echo $foodname;?></td>
                                                <td><?php echo $price;?></td>
                                                <td><?php echo $date;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                                <span style="color:green; text-align:centre;"></span>
                            </div>
                            <?php
                                    }
                                }
                            }
                            catch(PDOException $e)
                            {
                                echo "failed to establish a connection with the database. server might be off";
                            }

                        ?>
                            <!--tab 1 ends-->
                                
                            <!--tab 2 starts-->
                            <?php
                            //getting the order from the db

                            $stmt= $conn->prepare("SELECT * FROM users");
                            $stmt->execute();

                            if($stmt->rowCount())
                            {
                                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    $id = $data['id'];
                                    $name = $data['names'];
                                    $email = $data['emails'];
                                    $phone = $data['phone'];
                                    $location = $data['locations'];
                                    $type = $data['types'];
                                    $date = $data['updated_at'];
                        ?>
                            <div class="tab-pane fade" id="manageaccount" style="margin-top:50px;" role="tabpanel" aria-labelledby="manageaccount-tab">
                                <div class="container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">user id</th>
                                                <th scope="col">user name</th>
                                                <th scope="col">email</th>
                                                <th scope="col">phone number</th>
                                                <th scope="col">locations</th>
                                                <th scope="col">user type</th>
                                                <th scope="col">updated at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $id;?></td>
                                                <td><?php echo $name;?></td>
                                                <td><?php echo $email;?></td>
                                                <td><?php echo $phone;?></td>
                                                <td><?php echo $location;?></td>
                                                <td><?php echo $type;?></td>
                                                <td><?php echo $date;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                            <?php
                            }
                        }
                        ?>
                             
                            <!--tab 4-->
                            <?php
                            //getting the order from the db

                            $stmt= $conn->prepare("SELECT * FROM orders");
                            $stmt->execute();

                            if($stmt->rowCount())
                            {
                                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    $foodid = $data['foodId'];
                                    $payment = $data['paymentType'];
                                    $orderBy = $data['orderBy'];
                                    $price = $data['price'];
                                    $date = $data['updated_at'];
                        ?>
                            <div class="tab-pane fade" style="margin-top:50px;" id="orderstatus" role="tabpanel" aria-labelledby="orderstatus-tab">
                                <table class="table">
                                    <tbody>
                                        <th>Order Id</th>
                                        <th>Customer Email</th>
                                        <th>payment Type</th>
                                        <th>ORDER COST</th>
                                        <th>Update Status</th>
                                        <tr>
                                            <td><?php echo $foodid?></td>
                                            <td><?php echo $orderBy?></td>
                                            <td><?php echo $payment?></td>
                                            <td><?php echo $price?></td>
                                            <td><?php echo $date?></td>
                                        <tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            }
                        }
                        ?>
                        </div>
                    </div>
                    <div class="footer-basic" style="margin-left:640px;">
                        <footer>
                            <p class="copyright">SK'HAFTHINI--- The Bearer © 2020</p>
                        </footer>
                    </div>
                </body>
            </html>	
            <?php
            //beggining
        }
    }
    else
    {
        header("Location: /index.php?error=unauthorised page request");
    }
?>