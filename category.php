<?php
include 'include/connectDB.php';
session_start();
$_SESSION['username'];
$msg = '';

if (isset($_POST['submit'])) {
    $newCategory = $_POST['new_category'];
    if (empty($newCategory)) {
        $msg = 'pleas write category Name!';
    } else {

        $query = "INSERT INTO categories (categoryName)VALUES ('$newCategory')";
        mysqli_query($conn, $query);
        $msg = 'Added successfully!';
    }
};



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE  FROM categories WHERE id='$id'";
    $res = mysqli_query($conn, $query);
    if (isset($res)) {
        $msg = "Post Deleted!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>Admin</title>
    <!---fonts---->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Noto+Serif:ital@0;1&display=swap"
        rel="stylesheet">
    <!-------->
    <!---css---->
    <link rel="stylesheet" href="css/dashboard.css" type="text/css">
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
        <a class="navbar-brand" href="home.php">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav  ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#"> <?php echo $_SESSION['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php"><i class="fab fa-blogger-b"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </div>
    </nav>
    <!---end navbar--->

    <!---start content-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4>Dashboard</h4>
                    <ul class="side">
                        <li><a href="#">
                                <span><i class="fas fa-tags"></i></span>
                                <span>Categories</span>
                            </a>
                        </li>
                        <!----articles---->
                        <li data-toggle="collapse" data-target="#menu">
                            <a href="#">
                                <span><i class="far fa-newspaper"></i>

                                </span>
                                <span>Articles</span>
                            </a>
                        </li>
                        <ul class="collapse" id="menu" class="menu">
                            <li>
                                <a href="new-post.php">
                                    <span><i class="far fa-edit"></i>

                                    </span>
                                    <span>New Articles</span>

                                </a>
                            </li>
                            <li>
                                <a href="All-Articles.php">
                                    <span><i class="fas fa-globe-americas"></i>

                                    </span>
                                    <span>All Articles</span>

                                </a>
                            </li>
                        </ul>
                        <!--------------------------------->
                        <li><a href="home.php">
                                <span><i class="fab fa-blogger-b"></i></span>
                                <span>Blog</span>
                            </a>
                        </li>
                        <li><a href="logout.php">
                                <span><i class="fas fa-sign-out-alt"></i>

                                </span>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10" id="main-area">
                    <div class="add-category">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <h4 style="text-align: center;color:red"><?php echo $msg; ?></h4>
                            <div class="form-group">
                                <label for="formGroupExampleInput">New Category</label>
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                    placeholder="write new category" name="new_category">
                                <button type="submit" class="btn btn-secondary" name="submit">Add</button>

                            </div>
                        </form>
                    </div>
                    <!--display category-->
                    <div class="display-cat mt-5">
                        <table class="table table-bordered">
                            <tr>
                                <th>Cate_Num</th>
                                <th>Cate_Name</th>
                                <th>Date</th>
                                <th>Edit</th>

                            </tr>
                            <?php


                            $query = "SELECT * FROM categories order by id desc ";
                            $res = mysqli_query($conn, $query);
                            $num = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $num++;
                            ?>
                            <tr>
                                <td><?php echo $num ?></td>
                                <td><?php echo $row['categoryName'] ?></td>
                                <td><?php echo $row['categoryDate'] ?></td>
                                <td> <a href="category.php?id=<?php echo $row['id'] ?>"> <button type="submit"
                                            class="btn btn-danger">Delete</button> </a></td>
                            </tr>

                            <?php
                            }


                            ?>
                        </table>
                    </div>
                    <!-------------------->
                </div>
            </div>
        </div>
    </div>
    <!---start content-->
    <!---jquery--->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <!---bootstrap--->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>