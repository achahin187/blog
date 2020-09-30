<?php
include 'include/connectDB.php';
include 'include/header.php';
$_SESSION['username'];

?>
<?php
$msg = "";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE  FROM posts WHERE id='$id'";
    $res = mysqli_query($conn, $query);
    if (isset($res)) {
        $msg = "Post Deleted!";
    }
}


?>


<!--display articles-->
<div class="display-cat mt-5">
    <h4 style="text-align: center;color:red"><?php echo $msg; ?></h4>

    <table class="table table-bordered">
        <tr>
            <th>Art_Num</th>
            <th>Title</th>
            <th>Categor</th>
            <th>Image</th>
            <th>Date</th>
            <th>Author</th>
            <th>Edit</th>
        </tr>
        <?php
        $query = "SELECT * FROM posts order by id desc ";
        $res = mysqli_query($conn, $query);
        $num = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $num++;
        ?>
        <tr>
            <td><?php echo $num ?></td>
            <td><?php echo $row['postTitle'] ?></td>
            <td><?php echo $row['postCategory'] ?></td>
            <td>
                <img src="images/<?php echo $row['postImage'] ?>" width="150" height="150">
            </td>
            <td><?php echo $row['postDate'] ?></td>
            <td><?php echo $row['postAuthor'] ?></td>
            <td> <a href="All-Articles.php?id=<?php echo $row['id']  ?>"><button type="submit"
                        class="btn btn-danger">Delete</button></a></td>
        </tr>

        <?php
        }


        ?>
    </table>
</div>


<!-------------------->



<?php include 'include/footer.php'   ?>