<?php
    session_start();
    //checking if the session is set
    if(isset($_SESSION['auth']))
    {
        if($_SESSION['authType'] != "restaurant")
        {
            header("Location: /index.php?error=unauthorised page request");
        }
        else
        {
            //end of the first cut
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
            <title>Bootstrap Example</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
                <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
                <link rel="stylesheet" href="css/font.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
                <style>
                    ul li{}
                    ul li a {color:white;padding:40px; }
                    ul li a:hover {color:white;}
                </style>

            </head>
            <body>

            <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            
                <a class="navbar-brand" href="index.php"><span style="margin-left:60px;color:green;font-family: 'Permanent Marker', cursive;">Sk’hafthini</span></a>
                <a class="navbar-brand" style="color:black; text-decoration:none;"><i class="far fa-user"></i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" style="margin-left:1100px;color:black; text-decoratio:none;" id="navbarResponsive">
                    <a class="nav-link" href="../app/Logout.php">
                        <ul class="navbar-nav ml-auto">
                            <button class="btn btn-outline-success">Log Out</button>
                        </ul>
                    </a>
                </div>
            </nav>
            <!--navbar ends-->
            <br>
            <div class="middle" style="margin-left:150px; padding:40px; border:1px solid #ED2553;  width:80%;">
                <!--tab heading-->
                <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="home" aria-selected="true">Manage Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="profile" aria-selected="false">Add Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="accountsettings-tab" data-toggle="tab" href="#accountsettings" role="tab" aria-controls="accountsettings" aria-selected="false">Account Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Order Status</a>
                    </li>
                    
                </ul>
                <br><br>
                <span style="color:green;"></span>

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
                                    $foodimage = $data['foodImage'];
                                    $foodname = $data['foodname'];
                                    $price = $data['price'];
                                    $date = $data['updated_at'];
                    ?>
                        <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="home-tab">
                            <div class="container"> 
                                <table bordercolor="#F0F0F0" cellpadding="20px">
                                <th>food Image</th>
                                <th>food name</th>
                                <th>food Price</th>
                                <th>updated at  </th>
                                <th>Delete Item   </th>
                                <th>foof number </th>
                                <tr>           
                                    <td><img src="<?php echo "../app/uploads/$foodimage" ?>" height="100px" width="150px"></td>
                                    <td style="width:150px;"><?php echo $foodname;?></td>
                                    <td style="width:150px;"><?php echo $price;?></td>
                                    <td style="width:150px;"><?php echo $date;?></td>
                                    <td style="width:150px;">
                                        <a id="director_rejobs_link" href="#" data-target="#order_list" data-toggle="modal"><button type="button" class="btn btn-warning">Delete food</button></a>
                                    </td>
                                    <td style="width:150px;"><?php echo $id;?></td>
                                </tr>
                                </table>
                            </div>    	 
                        </div>
                        <br>
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
                        <div class="tab-pane fade" id="manageaccount" style="width:550px;margin-left:200px;" role="tabpanel" aria-labelledby="profile-tab">
                                <!--add Product-->
                            <form action="../app/Uploads.php" method="post" enctype="multipart/form-data">
                                <div class="form-group"><!--food_name-->
                                <label for="food_name">Food Name:</label>
                                        <input type="text" class="form-control" id="food_name" value="" placeholder="Enter Food Name" name="food_name" required>
                                </div>
                                <div class="form-group"><!--cost-->
                                        <label for="cost">Cost :</label>
                                        <input type="number" class="form-control" id="cost"  value="" placeholder="10000" name="cost" required>
                                </div>
                                <div class="form-group">
                                    <input type="file" accept="image/*" name="image" required/>Food Snaps 
                                </div>
                                <button type="submit" name="add" class="btn btn-primary">ADD Item</button>
                            </form>
                        </div>
                        <!--tab 2 ends-->
                        
                        
                        <!--tab 3-- starts-->
                        <?php
                            //getting the order from the db

                            $stmt= $conn->prepare("SELECT id,emails,updated_at FROM users WHERE emails=?");
                            $stmt->bindValue(1,$_SESSION['auth']);
                            $stmt->execute();

                            if($stmt->rowCount())
                            {
                                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    $foodid = $data['id'];
                                    $email = $data['emails'];
                                    $date = $data['updated_at'];
                        ?>
                        <div class="tab-pane fade" id="accountsettings" role="tabpanel" aria-labelledby="accountsettings-tab">
                            <table class="table">
                                <tbody>
                                    <th>your Id</th>
                                    <th>your Email</th>
                                    <th>Update Status</th>
                                    <tr>
                                        <td><?php echo $foodid?></td>
                                        <td><?php echo $email?></td>
                                        <td><?php echo $date?></td>
                                    <tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                            }
                        }
                        ?>
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
                        
                        <div class="tab-pane fade " id="status" role="tabpanel" aria-labelledby="status-tab">
                            <table class="table">
                                <tbody>
                                    <th>Order Id</th>
                                    <th>Customer Email</th>
                                    <th>Food Id</th>
                                    <th>Order Status</th>
                                    <th>Update Status</th>
                                    <tr>
                                        <td><?php echo $foodid?></td>
                                        <td><?php echo $payment?></td>
                                        <td><?php echo $orderBy?></td>
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
                <!-- deleting the order or canceling the order -->
                <div class="modal fade" role="dialog" tabindex="-1" id="order_list" style="margin-top: 70px;font-style:normal;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center" style="width: 100%;">Delete food item</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <form action="../app/OrderInputs.php" method="post">
                                        <input type="text" class="form-control" id="food_name" value="" placeholder="Enter food number" name="food_number" required>
                                        <button type="submit" name="delete" class="btn btn-danger">Delete food</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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