<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Titulo</title>
        <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width" />
        <link href="site.css" rel="stylesheet" type="text/css">
    </head>
    <body >
        <header>
            <div class="content-wrapper ">
                <div class="float-left">
                    <a href="" >Teste Logo</a>
                </div>
                <div class="float-right">
                    <section id="login">
                        <?php include_once("_LoginPartial.php")?>
                    </section>
                    <nav>
                        <ul id="menu">
                            <li><a href="index.php" >HOME</a></li>
                            <li><a href="cliente_index.php" >CLIENTE</a></li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <div id="body">
            <section class="content-wrapper main-content clear-fix">
            
