<?php header('HTTP/1.0 404 Not Found'); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
   <meta charset="utf-8">  
<title>404 ERROR : We Are not Here</title>
<style type="text/css" media="screen">
            body{
                background: #000;
                width:800px;
                margin: 0 auto;
            }
 
        </style>
</head>
<body>
<img alt="404 Not Found" src="<?php echo Config::read('site'); ?>assets/img/404droids.jpg" />
</body>
</html>