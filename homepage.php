<?php
require 'config.php';
// عند الكتابة في URL 
// للدخول الى الصفحة الرئيسية .. ف يجب تسجيل الدخول اولاَ
if (!isset($_SESSION['user_Id']) || empty($_SESSION['user_Id'])){
    header("Location: login.php");
}
$userId = $_SESSION['user_Id'];
$name = $_SESSION['username'];

//print_r($_SESSION);
date_default_timezone_set('Asia/Gaza');
$created_datetime =  date('y:m:d h:i:s a');


if (isset($_POST['btnpost'])) {

    $txt = $_POST['post_ma'];
    $nameimg = $_FILES['post_img']['name'];
    $temp = $_FILES['post_img']['tmp_name'];
    $arr = explode('.', $nameimg);
    $ext = end($arr);
    $current = getcwd() . "\\image\\$nameimg";
    move_uploaded_file($temp, $current);

    if (!empty($_POST['post_ma'] or !empty($_FILES['post_img']['name']))) {
        
        $sql = "INSERT INTO user_post (written_text , userId , created_datetime, img_url) 
        VALUE ('$txt' , '$userId' , '$created_datetime', '$nameimg')";
        $res = mysqli_query($conn, $sql);
    }
}
if (isset($_POST['subcomment'])) {
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    if (!empty($_POST['comment'])) {

        $sql = "INSERT INTO post_comment (comment_text , userId , created_datetime,post_id)
         VALUE ('$comment' , '$userId' , '$created_datetime','$post_id')";
        $res = mysqli_query($conn, $sql);
    }

}
if (isset($_POST['delete'])){
    $sql = "DELETE FROM user_post WHERE post_id = " . $_POST['post_id'];
    $res = mysqli_query($conn, $sql);
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="stylehome.css">
    <title>MediaBook</title>
</head>

<body>

    <nav>
        <div class="nav-left">
            <img src="./images/logo.png" alt="Logo">
            <input type="text" placeholder="Search Mediabook..">
        </div>

        <div class="nav-middle">
           

            <a href="profile.php">
                <i class="fa fa-users"> Profile</i>
            </a>
        </div>

        <div class="nav-right">
        <?php
            $sql3 = "SELECT name_img from users WHERE userId=" . $userId;
            $result = mysqli_query($conn, $sql3);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $img = './image/' . $row['name_img'];

                    echo "<img src='$img' style='max-width:50px ';>";
                }
            }
            ?>

            <a href="#">
                <i class="fa fa-bell"></i>
            </a>

            <a href="logout.php" style="text-align: center;" >
            log out
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="left-panel">
            <ul>
                <li>
                    
                <?php
                    $sql3 = "SELECT name_img from users WHERE userId=" . $userId;
                    $result = mysqli_query($conn, $sql3);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $img = './image/' . $row['name_img'];
                            echo "<img src='$img' style='max-width:50px ';>";
                        }
                    }
                    ?>
                    <p> <?php echo $name ?></p>
                </li>
                <li>
                    <i class="fa fa-user-friends"></i>
                    <p>Friends</p>
                </li>
                <li>
                    <i class="fa fa-play-circle"></i>
                    <p>Videos</p>
                </li>
                <li>
                    <i class="fa fa-flag"></i>
                    <p>Pages</p>
                </li>
                <li>
                    <i class="fa fa-users"></i>
                    <p>Groups</p>
                </li>
                <li>
                    <i class="fa fa-bookmark"></i>
                    <p>Bookmark</p>
                </li>
                <li>
                    <i class="fab fa-facebook-messenger"></i>
                    <p>Inbox</p>
                </li>
                <li>
                    <i class="fas fa-calendar-week"></i>
                    <p>Events</p>
                </li>
                <li>
                    <i class="fa fa-bullhorn"></i>
                    <p>Ads</p>
                </li>
                <li>
                    <i class="fas fa-hands-helping"></i>
                    <p>Offers</p>
                </li>
                <li>
                    <i class="fas fa-briefcase"></i>
                    <p>Jobs</p>
                </li>
                <li>
                    <i class="fa fa-star"></i>
                    <p>Favourites</p>
                </li>
            </ul>

            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Advance</a>
                <a href="#">More</a>
            </div>
        </div>

        <div class="middle-panel">

            <div class="post create">
                <div class="post-top">
                    <div class="dp">
                    <?php
                        $sql3 = "SELECT name_img from users WHERE userId=" . $userId;
                        $result = mysqli_query($conn, $sql3);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $img = './image/' . $row['name_img'];

                                echo "<img src='$img' style='max-width:90px ';>";
                            }
                        }
                        ?>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <textarea name="post_ma" placeholder="What's on your mind, Aashish ?"></textarea>
                        <input type="file" name="post_img">
                        <input name="btnpost" type="submit" value="Post">
                    </form>

                </div>

                <div class="post-bottom">
                    <div class="action">
                        <i class="fa fa-video"></i>
                        <span>Live video</span>
                    </div>
                    <div class="action">
                        <i class="fa fa-image"></i>
                        <span>Photo/Video</span>
                    </div>
                    <div class="action">
                        <i class="fa fa-smile"></i>
                        <span>Feeling/Activity</span>
                    </div>
                </div>
            </div>

            <?php

            $sql2 = "SELECT p.written_text, p.created_datetime, p.userId, p.post_id, p.img_url,u.username, u.name_img
            FROM user_post as p JOIN users as u WHERE p.userId = u.userId  ORDER BY p.created_datetime DESC";
            $res = mysqli_query($conn, $sql2);
 
             
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $comments_count_result = mysqli_query($conn, "SELECT COUNT(*) FROM post_comment WHERE post_id = $row[post_id]");
                    $count_row = $comments_count_result->fetch_array();
                    $comments_count = $count_row[0];
                    $post_img = './image/' . $row['img_url'];
                    $img = './image/' . $row['name_img'];
     echo '<div class="post">
                <div class="post-top">
                    <div class="dp">
                        <img src="' . $img . '" alt="">
                    </div>
                    <div class="post-info">' .
                        '<p class="name">' . $row['username'] . '</p>' .
                        '<span class="time">' . $row['created_datetime'] . '</span>' .
                    '</div>
                <i >
                <form action="" method="post">
                <input type="hidden" name="post_id" value=' . $row['post_id'] . '>
                    <input type="submit" name="delete" value="Delete post">
                    </form>
</i>
                </div>
            
            <div class="post-content">' .
                        $row['written_text'] . 
            '</div>'.
        
            '
            <div>
            <img src="' . $post_img . '" style="max-width: 400px" alt="">
    </div>
            <div>
                <span style= margin:5px>' . $comments_count . '</span>    
                <i class="far fa-comment"></i>
                <span>Comments</span>
                <br>
                <form method="post" action="">
                    <input type="hidden" name="post_id" value= ' . $row['post_id'] . '>
                    <input class="post-content" type="text" name="comment" placeholder="Type comment" >
                    <input type="submit" value="comment" name="subcomment">
                </form> 
                <div class = "commentst">' . '<br>';
                $sql = "SELECT c.comment_text ,c.created_datetime ,c.userId ,c.comment_id,c.post_id, 
                u.username FROM post_comment as c JOIN users as u WHERE post_id = $row[post_id] and
                 u.userId = c.userId  ORDER BY c.created_datetime DESC";
                $res2 = mysqli_query($conn, $sql);
                if ($res2->num_rows > 0) {
                    while ($row2 = $res2->fetch_assoc()) {
                     echo '<div class = "comments">';

                     echo " <img style = 'border: 1px solid #ddd; border-radius: 100%;  width: 40px;'src= '$img';";
                     

                        echo "<p>  $row2[username] </p>" . "<br>" .
                         "<p> comment :  $row2[comment_text] </p> ". "<br>" . 
                        "<span class = 'time'> $row2[created_datetime] </span>" . '</div>' . '<br>';
                        
        
                                }
                            }
            echo '</div></div>
            </div>';
                           
                }
            }
            
            ?>        
        </div> 
</body>

</html>