<?php
include "include/connectDB.php";
session_start();
$_SESSION['username'];

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
        <a class="navbar-brand" href="home.php" title="Home">Blog</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="form-inline my-2 my-lg-0" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="find">Search</button>
        </form>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav  ml-auto">

                <!---------drobdown------->
                <!------------------->

                <div class="dropdown" style="margin-right:50px">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['username']; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="category.php">Dashboard</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>



                <!-- Modal ----------------------------------->


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
                        <h4 title="Title"><?php echo $row['postTitle'] ?> </h4>
                    </div>
                    <div class="post-details">
                        <p class="post-info">
                            <span title="Bloger"><i class="fas fa-user"></i><?php echo $row['postAuthor'] ?>
                            </span>
                            <span><i class="far fa-calendar-alt"></i><?php echo $row['postDate'] ?></span>
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
                            <h4 title="Title"><?php echo $row['postTitle'] ?> </h4>
                        </div>
                        <div class="post-details">
                            <p class="post-info">
                                <span title="Bloger"><i class="fas fa-user"></i><?php echo $row['postAuthor'] ?>
                                </span>
                                <span><i class="far fa-calendar-alt"></i><?php echo $row['postDate'] ?></span>
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
                                <span class="float-left"> <img src="images\<?php echo $row['postImage'] ?>" alt=""
                                        style="height:100px; width:100px "></span>
                                <span>
                                    <h4><?php echo $row['postContent'] ?></h4>
                                </span>

                            </li>
                        </ul>
                        <?php
}
?>




                    </div>
                </div>



            </div>
            <!--end content-->

            <!---------- Footer ------------>

            <div>
                <footer style="text-align: center">
                    <p style="text-align: center; color:black">Blog &copy; 2020</p>

                </footer>
            </div>


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