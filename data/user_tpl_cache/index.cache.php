<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xcms</title>
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <style>
        .user_info {
           margin-right: 10px;
           margin-top: 7px;
        }
        h1 {
            margin-top: 50px;
            margin-left: 20px;
        }
        .post_content{
                border: aquamarine;
                background: bisque;
                border-width: 10px;
                width: 50%;
                height: 50%;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php if ($user_name) { ?>
        <p class="user_info"><b>hello,<?php echo $user_name; ?></b></p>
        <?php }else{ ?>
        <p class="user_info"><b>hello, GUEST</b></p>
        <a href="index.php?c=login&a=index">login</a>
        <?php } ?>
    </div>
    <div class="body">
        <h1>POSTS</h1>
        <div class="post_content">
            <table>
                <tr>
                    heheda
                </tr>
            </table>
        </div>
    </div>
</body>
</html>