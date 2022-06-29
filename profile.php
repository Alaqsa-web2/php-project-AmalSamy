<?php
// Amal Samy Abo_Ouda
require "config.php";
$name = $_SESSION['username'];
$userId = $_SESSION['user_Id'];
$email = $_SESSION['email'];




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="stylehome.css">
    <title>Profile</title>
</head>
<style type="text/css">
    #friend-bar {
        background-color: white;
        min-height: 500px;
        margin-top: 20px;
        color: #aaa;
        padding: 8px;
        text-align: center;
    }

    #friends {
        clear: both;
        font-size: 20px;
        font-weight: bold;
        color: #405d9b;
        text-align: center;

    }

    #post_bar {
        margin-top: 20px;
        background-color: white;
        padding: 10px;
    }

    #post {
        padding: 4px;
        font-size: 13px;
        display: flex;
        margin-bottom: 20px;
    }
</style>

<body style="background:#d0d8e4">


    <div style="display:flex;">
        <div style="min-height:400px;flex:1;">
            <div id="friend-bar">
                information personal <br>
                <br>
                <br>
                <div id="friends">

                    <p>user name : <?php echo $name ?></p>

                    <br>
                    <br>
                    <br>
                    <?php
                    $sql3 = "SELECT name_img from users WHERE userId=" . $userId;
                    $result = mysqli_query($conn, $sql3);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                            $img = $row['name_img'];
                            $img_src = "image/" . $img;
                            echo"<img src='$img_src'>";
                        
                    }

                    ?>
                    

                    <br>
                    <br>
                    <br>
                    <p> email : <?php echo $email; ?></p>
                    <br>
                    <br>
                    <br>
                    <a href="homepage.php" style="text-align: center;">
                        Go To Homepage
                    </a>

                </div>

            </div>
        </div>
        <!-- post -->
        <div style="min-height:400px;flex:2.5;padding:20px;padding-right:0px">
            <div style="border:solid thin #aaa ; padding:10px; background-color:white">


                <?php

                $sql2 = "SELECT p.written_text, p.created_datetime, p.userId, p.post_id,u.username, u.name_img
                FROM user_post as p JOIN users as u WHERE p.userId = u.userId and p.userId = $_SESSION[user_Id] ORDER BY p.created_datetime DESC";
                $res = mysqli_query($conn, $sql2);

                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $comments_count_result = mysqli_query($conn, "SELECT COUNT(*) FROM post_comment WHERE post_id = $row[post_id]");
                        $count_row = $comments_count_result->fetch_array();
                        $comments_count = $count_row[0];
                        $img = $row['name_img'];
                        $img_src = "image/" . $img;
                        echo '<div class="post">
    <div class="post-top">
        <div class="dp">
            <img src="' . $img_src . '" alt="">
        </div>
        <div class="post-info">' .
                            '<p class="name">' . $row['username'] . '</p>' .
                            '<span class="time">' . $row['created_datetime'] . '</span>' .
                            '</div>
        
    <i class="fas fa-ellipsis-h"></i>
    </div>

<div class="post-content">' .
                            $row['written_text'] .
                            '</div>' .

                            '<div>

    <span>' . $comments_count . '</span>  
    
    <i class="far fa-comment"></i>
    <span>Comments</span>
    <br>
    <form method="post" action="">
        <input type="hidden" name="post_id" value= ' . $row['post_id'] . '>
        <input type="text" name="comment" placeholder="Type comment" >
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
                                echo "<span>  $row2[username] </span>" .
                                    "<p> $row2[comment_text] </p>" .
                                    "<span class = 'time'> $row2[created_datetime] </span>" . '</div>' . '<br>';
                            }
                        }
                        echo '</div></div>
</div>';
                    }
                }

                ?>


            </div>


        </div>

    </div>

</body>

</html>