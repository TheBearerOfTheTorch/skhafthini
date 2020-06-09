<?php
    session_start();
    //checking if the session is set
    if(isset($_SESSION['auth']))
    {
        if($_SESSION['authType'] != "client")
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
                <title>View Food</title>
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
                    <div class="container">
                        <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Sk’hafthini</span></a>
                        
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                        <!-- this for the drop down -->
                            <button
                                data-toggle="collapse" class="navbar-toggler collapsed" data-target="#navcol-1">
                                <span>MENU</span>
                            </button>
                            <div class="collapse navbar-collapse text-center" id="navcol-1">
                                <ul class="nav navbar-nav ml-auto">
                                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"><i class="far fa-bell" style="font-size: 23px;"></i></a></li>
                                    <li class="dropdown nav-item">
                                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Profile</a>
                                        <div class="dropdown-menu text-center" style="color:white" role="menu">
                                            <a class="dropdown-item" role="presentation" href="../app/Logout.php">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <!--navbar ends-->

                <!--details section-->
                <div class="container" style="margin-top:20px;">
                    <!--tab 1 starts-->   
                    <a id="director_rejobs_link" href="#" data-target="#order_list" data-toggle="modal" style="margin-left:450px;">
                        <button type="button" class="btn btn-danger"><h4>View your order list</h4> </button>
                    </a>
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
                    
                        <div class="tab-pane fade show active" style="margin-top:30px;" id="viewitem" role="tabpanel" aria-labelledby="viewitem-tab">
                            <div class="container">
                                <div class="card">
                                    <div class="card-header" style="margin-left:340px;margin-right:330px;">
                                        <h3>order food items below</h3>
                                        <h6><?php echo "Food number: ".$id; ?></h6>
                                        <?php echo "Food price: ".$price; ?><br>
                                        <?php echo "upladet at: ".$date; ?>

                                    </div>
                                    <div class="card-body" style="margin-left:440px; hight:100px;">
                                        <img src="<?php echo "../app/uploads/$foodimage" ?>" height="140px" width="190px">
                                        <br><br>
                                        <a id="director_rejobs_link" href="#" style="color: rgba(30, 218, 162, 0.932); margin-left:50px;" data-target="#add_employee" data-toggle="modal">
                                            <button type="button" class="btn btn-warning">Place Order </button>
                                        </a>
                                    </div>
                                </div>
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
                        <div class="tab-pane fade" id="manageaccount" style="margin-top:50px;" role="tabpanel" aria-labelledby="manageaccount-tab">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="username" class="form-control" name="name" readonly="readonly"/>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input type="password" name="password" class="form-control" id="pwd" required/>
                                </div>
                                <button type="submit" name="update" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                                <div class="footer" style="color:red;">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- view order list -->
                <div class="modal fade" role="dialog" tabindex="-1" id="order_list" style="margin-top: 70px;font-style:normal;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center" style="width: 100%;">Your order list</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>orderID</th>
                                                    <th>food number</th>
                                                    <th>payment</th>
                                                    <th>time of order</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" id="project_name">
                                                        <?php
                                                            $stmt = $conn->prepare("SELECT id FROM orders");
                                                            $stmt->execute();
                                                            if($stmt->rowCount())
                                                            {
                                                                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo $data['id']."<br>";
                                                                }
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                    <td class="text-center" id="project_id">
                                                        <?php
                                                            $stmt = $conn->prepare("SELECT * FROM orders");
                                                            $stmt->execute();
                                                            if($stmt->rowCount())
                                                            {
                                                                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo $data['foodId']."<br>";
                                                                }
                                                            }
                                                                
                                                        ?>
                                                    </td>
                                                    <td class="text-center" id="project_members">
                                                        <?php
                                                            $stmt = $conn->prepare("SELECT * FROM orders");
                                                            $stmt->execute();
                                                            if($stmt->rowCount())
                                                            {
                                                                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo $data['paymentType']."<br>";
                                                                }
                                                            }  
                                                        ?>
                                                    </td>
                                                    <td class="text-center" id="project_progress">
                                                        <?php
                                                            $stmt = $conn->prepare("SELECT * FROM orders");
                                                            $stmt->execute();
                                                            if($stmt->rowCount())
                                                            {
                                                                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    echo $data['updated_at']."<br>";
                                                                }
                                                            }   
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- this the first in the second -->
                <div class="modal fade" role="dialog" tabindex="-1" id="add_employee" style="margin-top: 70px;font-style:normal;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center" style="width: 100%;">Place food order</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <form action="../app/OrderInputs.php" method="post">
                                        <input type="text" class="form-control" id="food_name" value="" placeholder="Enter food number" name="food_number" required>
                                        <div class="form-group"><!--payment_mode-->
                                            <input type="radio" checked="checked" name="payment" value="cash on delivery">Cash On Delivery<br>
                                            <input type="radio" name="payment" value="online delivery">Online Payment
                                            <br>
                                        </div>
                                        <button type="submit" name="order" class="btn btn-warning">ADD Item</button>
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
            <?php
            //beggining
        }
    }
    else
    {
        header("Location: /index.php?error=unauthorised page request");
    }
?>