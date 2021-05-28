<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img {
            outline: 2px solid black;
        }
    </style>
</head>
<body>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        <label for="file">Загрузить картинку</label>
        <br><br>
        <input type="file" name="file" id="file">
        <br><br>
        <input type="submit" value="Submit">
    </form>
    <div>
        <br>
        <?php foreach ($images as $image) : ?>
            <img src="/test/<?php echo $image->id ?>"><br><br>
        <?php endforeach; ?>
    </div>
</body>
</html>
