<?php

    session_start();
    if( isset($_SESSION['usuario'])!= "portafolio" ){ //verificamos que el usuario sea correcto
                                                      //si el usuario no esta logeando entonces no pasa del login

        header("location:login.php"); //direccionamiento de pagina
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <a href="index.php">Inicio </a>|
        <a href="portafolio.php">Portafolio </a>|
        <a href="cerrar.php">Cerrar </a>
        <br/>
    


    