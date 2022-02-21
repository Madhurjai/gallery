<?php
$arr = array();
session_start();

$_SESSION['submit_pic'] = $_POST['submit'];
$src = $_FILES["image"]["tmp_name"];
$destination = "uploads/" . $_FILES["image"]["name"];
$_SESSION['img_type'] = strtolower(pathinfo($_SESSION['desti'], PATHINFO_EXTENSION));
$_SESSION['img'];
$_SESSION['msg'] = "";
if (isset($_SESSION['submit_pic'])) {
    $_SESSION['check'] = getimagesize($src);

    if ($_FILES["image"]['size'] > 200000) {
        $_SESSION['msg'] = "file size exceed";
    } elseif (move_uploaded_file($src, $destination)) {
        $_SESSION['img'][] = $destination;
        $_SESSION['msg'] = "file uploaded successfully";
    } else {
        $_SESSION['msg'] = "somthing wrong";
    }
}
array_push($arr, $_SESSION['img']);
print_r($arr);





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 10px;
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);

        }
        img{
            margin: 10px;
        }

       
    </style>
</head>

<body>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data" class="">
            <input type="file" name="image" id="img">
            <input type="submit" name="submit" value="submit">
            <?php echo $_SESSION['msg'] ?>
        </form>

        <?php
        //   session_destroy();

        foreach ($arr as $key => $val) {
            foreach ($val as $v) {
                echo "<img src = " . $v . " width = '200' height = '200'> 
           ";
            };
        };

        ?>

    </div>
</body>

</html>