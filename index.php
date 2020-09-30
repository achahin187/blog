 <?php
    include "include/connectDB.php";
    session_start();
    /*----- signup---*/
    $call = "";
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $_SESSION['username'] = $username;
        $password = $_POST['password'];
        if (empty($_POST['email'])) {
            $call = 'pleas write your email!';
        } else if (empty($_POST['username'])) {
            $call = 'pleas write your username!';
        } else if (empty($_POST['password'])) {
            $call = 'pleas write your  password!';
        } else {

            $query = "INSERT INTO signup (email,username,password) VALUES ('$email','$username','$password')";
            $res = $conn->query($query);
            $_SESSION['username'];
            header('location:home.php');
        }
    }
    /*----------------------------*/
    /*----------------- login--------*/
    $measage = "";

    if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $_SESSION['username'] = $username;
        $password = $_POST['password'];
        if (empty($_POST['username'])) {
            $msg = "pleas write your username!";
        } elseif (empty($_POST['password'])) {
            $msg = 'pleas write your  password!';
        } else {
            $query = "SELECT * FROM signup WHERE username='$username' AND password='$password'";
            $res = $conn->query($query);
            $row = mysqli_fetch_array($res);
            if (in_array($username, $row) && (in_array($password, $row))) {
                session_start();
                $_SESSION['username'] = $_POST['username'];
                header("location:home.php");
            } else {
                header("location:index.php");

                $measage = "<div class='alert alert-danger' role='alert'>
            Username is not Exist!
              </div>";
            }
        }
    }

    ?>



 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-compatible" content="ie=edge">
     <title>Blog</title>
     <!---fonts---->
     <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Noto+Serif:ital@0;1&display=swap"
         rel="stylesheet">
     <!-------->
     <!---css---->
     <link rel="stylesheet" href="css/style.css" type="text/css">

     <!---------->
     <!----- icon--->

     <link rel="shortcut icon" href="img/icon.jpg">
     <!---bootstrap-->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
         integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <!----->


     <!--- font awsome-->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
         integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

     <!------------->


 </head>

 <body>
     <!---start navbar--->

     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <a class="navbar-brand" href="index.php" title="Home">Blog</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"
             aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <form class="form-inline my-2 my-lg-0" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
             <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
             <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="find">Search</button>
         </form>
         <!-------------------------------->
         <div class="collapse navbar-collapse" id="menu">
             <ul class="navbar-nav  ml-auto">
                 <!------------input login--->
                 <div style="margin-right:10px">
                     <a id="navbar-log" class="navbar-log btn btn-light" data-toggle="modal" data-target="#loginModal">
                         Login</a>
                 </div>
                 <!---------------->
                 <!------------input signup--->
                 <a id="navbar-log" class="navbar-log btn btn-light" data-toggle="modal" data-target="#signupModal">
                     <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>Sign Up</a>
                 <!--------------->


                 <!---form login---->

                 <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel"> Login</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 <!----- login -------->
                                 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">


                                     <div class="form-group">
                                         <label for="exampleInputEmail1">UserName</label>
                                         <input type="text" class="form-control" id="exampleInputEmail1"
                                             aria-describedby="emailHelp" name="username">

                                     </div>
                                     <div class="form-group">
                                         <label for="exampleInputPassword1">Password</label>
                                         <input type="password" class="form-control" id="exampleInputPassword1"
                                             name="password">
                                     </div>


                                     <button type="submit" class="btn btn-dark" name="login">Login</button>
                                     <h5 style="color: red; text-align:center "><?php echo $measage; ?></h5>

                                 </form>
                                 <!------- login---->
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             </div>
                         </div>
                     </div>
                 </div>



                 <!---form signup---->
                 <div class="modal fade" id="signupModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Sign Up OR Login</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 <!----- signup -------->
                                 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

                                     <div class="form-group">
                                         <label for="exampleInputEmail1">Email address</label>
                                         <input type="email" class="form-control" id="exampleInputEmail1"
                                             aria-describedby="emailHelp " name="email">
                                         <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                             with anyone else.</small>
                                     </div>
                                     <div class="form-group">
                                         <label for="exampleInputEmail1">UserName</label>
                                         <input type="text" class="form-control" id="exampleInputEmail1"
                                             aria-describedby="emailHelp" name="username">

                                     </div>
                                     <div class="form-group">
                                         <label for="exampleInputPassword1">Password</label>
                                         <input type="password" class="form-control" id="exampleInputPassword1"
                                             name="password">
                                     </div>

                                     <button type="submit" name="submit" class="btn btn-primary">SignUp</button>
                                     <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#loginModal"
                                         data-dismiss="modal">Login</a>
                                     <h5 style="color: red; text-align:center "><?php echo $call; ?></h5>

                                 </form>
                                 <!------- signup---->
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-------------------------->

                 <!--------------------
                 ---------------------->
             </ul>
         </div>
     </nav>

     <!---end navbar--->
     <!--start content-->


     <div class="content">
         <div class="container">
             <div class="row">
                 <div class="col-md-9">

                     <!--------------------- search bar------->
                     <?php
                        if (isset($_POST['find'])) {
                            $search = $_POST['search'];
                            $query = "SELECT * FROM posts WHERE (postTitle) LIKE '$search' ";
                            $res = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($res)) {

                        ?>
                     <div class="post-img">
                         <img src="images/<?php echo $row['postImage'] ?>" alt="image1">
                     </div>
                     <div class="post-title">
                         <h4 title="Title"><?php echo  $row['postTitle']  ?> </h4>
                     </div>
                     <div class="post-details">
                         <p class="post-info">
                             <span title="Bloger"><i class="fas fa-user"></i><?php echo $row['postAuthor'] ?>
                             </span>
                             <span><i class="far fa-calendar-alt"></i><?php echo $row['postDate']  ?></span>
                             <span title="Category"><i class="fas fa-tags"></i><?php echo $row['postCategory'] ?></span>

                         </p>
                         <p><?php echo $row['postContent'] ?> </p>


                     </div>
                     <?php
                            }
                        }


                        ?>
                     <!--------------------------------->
                     <div class="post">
                         <?php
                            $query = "SELECT * FROM posts ORDER BY id DESC";
                            $res = mysqli_query($conn, $query);
                            $num = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $num++;
                            ?>
                         <div class="post-img">
                             <img src="images/<?php echo $row['postImage'] ?>" alt="image1">
                         </div>
                         <div class="post-title">
                             <h4 title="Title"><?php echo  $row['postTitle']  ?> </h4>
                         </div>
                         <div class="post-details">
                             <p class="post-info">
                                 <span title="Bloger"><i class="fas fa-user"></i><?php echo $row['postAuthor'] ?>
                                 </span>
                                 <span><i class="far fa-calendar-alt"></i><?php echo $row['postDate']  ?></span>
                                 <span title="Category"><i
                                         class="fas fa-tags"></i><?php echo $row['postCategory'] ?></span>

                             </p>
                             <p><?php echo $row['postContent'] ?> </p>


                         </div>




                         <?php
                            }

                            ?>

                     </div>

                 </div>
                 <div class="col-md-3">
                     <!--- start categories-->
                     <div class="categories">
                         <h4>Links</h4>
                         <ul>
                             <li><a style="text-decoration: none" href="#">
                                     <span><i class="fas fa-tags"></i>Bloger</span>

                                 </a>
                             </li>
                             <li><a style="text-decoration: none" href="#">
                                     <span><i class="fas fa-tags"></i>Profile</span>

                                 </a>
                             </li>
                             <li><a style="text-decoration: none" href="#">
                                     <span><i class="fas fa-tags"></i>Youtube</span>

                                 </a>
                             </li>
                             <li><a style="text-decoration: none" href="#">
                                     <span><i class="fas fa-tags"></i>facebook</span>

                                 </a>
                             </li>
                             <li><a style="text-decoration: none" href="#">
                                     <span><i class="fas fa-tags"></i>News</span>

                                 </a>
                             </li>
                         </ul>
                     </div>
                     <!--- end categories-->
                     <!--- start latest posts--->
                     <div class="last-posts">



                         <?php
                            $query = "SELECT * FROM posts ";
                            $res = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($res)) {

                            ?>
                         <ul>
                             <li>
                                 <span class="float-left"> <img src="images\<?php echo $row['postImage']   ?>" alt=""
                                         style="height:100px; width:100px "></span>
                                 <span>
                                     <h4><?php echo $row['postContent']  ?></h4>
                                 </span>

                             </li>
                         </ul>
                         <?php
                            }
                            ?>




                     </div>
                 </div>

                 <!--end content-->
                 <!---------- Footer ------------>
                 <div class="contianer ">
                     <div class="col-md12-sm6 align-center">
                         <footer style="text-align: center ; ">
                             <p>All Ritghts Resrved &copy; 2020</p>
                         </footer>
                     </div>
                 </div>


                 <!-- Site footer -->

                 <!---jquery--->
                 <script src="js/jquery.js"></script>
                 <script src="https://code.jquery.com/jquery-3.5.0.min.js"
                     integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous">
                 </script>
                 <!---bootstrap--->
                 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                     integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
                     crossorigin="anonymous">
                 </script>
                 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                     integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                     crossorigin="anonymous">
                 </script>
                 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
                     integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
                     crossorigin="anonymous">
                 </script>
 </body>

 </html>