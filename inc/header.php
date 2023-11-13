<!doctype html>

<html lang="es">

<!--	Copiamos la plantilla de inicio del siguiente enlace: https://getbootstrap.esdocu.com/docs/5.1/getting-started/introduction/	-->

<html lang="en">

  <head>
  
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>My tasks</title>
	
    <style>
    
      body {
        margin: 0;
        padding: 0;
        display: flex;
        min-height: 100vh;
        background-color: #debbbb;
      }
    
      .container { 
        padding: 0;
        margin: 25px auto; 
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: 'Arial, sans-serif';
      }
      
      .container h1 { 
        font-size: 24px; 
        margin: 25px;
      }
      
      .container form { 
        width: 40%; 
        border: 1px solid black;
        padding: 35px;
        margin: 35px;
        border-radius: 7px;
      }
      
      .container form .mb-3 .form-label { margin: 15px auto; }
      
      .container form .mb-3 .form-control { margin: 5px auto; }
      
      .container form .mb-3 { margin: 15px auto; }
      
      .container form .mb3 .form-check-inline {  margin: 20px auto; }
      
      .container form .mb3 .form-check-label { margin-right: 25px; }
      
      .container form .nav-container-insert, .container form .nav-container-edit { display: flex; }
      
      .container form .nav-container-insert button, .container form .nav-container-edit button { margin: 20px auto; }
      
      .container table {
        width: 85%; 
        margin: 20px;
        border-radius: 8px;
        text-align: center;
      }	
      
      .nav-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
      }
      
      .nav-container a { margin-left: 50px; }
      
      .nav-container-index-1 {
        width: 100%;
        display: flex;
        margin: 20px;
        justify-content: space-around;
      }
      
      .nav-container-index-1 a { margin: 15px; }		
      
      .nav-container-index-2 {
        display: flex;
        justify-content: space-around;
      }
      
      .pagination-nav { margin-top: 30px; }
    
    </style>
	
  </head>