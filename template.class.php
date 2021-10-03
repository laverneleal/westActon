<?php 


 class template{

    public function template_header($title) {
        echo <<<EOT
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <title>$title</title>
                <link href="style.css" rel="stylesheet" type="text/css">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
                <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
                <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
                <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css'
                    media="screen" />
                <!-- Bootstrap -->
                <!-- Bootstrap DatePicker -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" type="text/css" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
                <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
                <script src="myscript.js" type="text/javascript"></script>
            </head>
            <body>
            <nav class="navtop">
                <div>
                    <h1>West Acton Stock Management</h1>
                    <a href="index.php"><i class="fas fa-home"></i>Home</a>
                    <a href="products.php"><i class=""></i>Products</a>
                    <a href="sales.php"><i class=""></i>Sales</a>
                </div>
            </nav>
        EOT;
    }

    public function template_welcome(){
        echo <<<EOT
            <div class="content">
            <h2>Home</h2>
            <p>Welcome to the home page!</p>
            </div>
        EOT;
    }

    public function template_footer($text_footer) {
        echo <<<EOT
                <div class="fixed-footer">
                    <div class="container">$text_footer</div>        
                </div>
            </body>
        </html>
        EOT;
    }

 }


 ?>