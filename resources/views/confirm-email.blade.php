<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body{
    padding: 0;
    margin: 0;
}
.container{
    display: flex;
    justify-content: center;
    width: 100vw;
    height: 100vh;
    background-color: #3D4148;
}

.wrapper{
    position: relative;
    top: 100px;
    background-color: white;
    flex-direction: column;
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    padding:  20px;
    width:  80%;
    height:  200px;
    border: 2px solid black;
    border-radius: 10px;
}

button {
    width:  150px;
    height:  50px;
    background-color: #2EFF69;
    color:  white;
    font-weight: bold;
    font-size: 20px;
    border: none;
}
    </style>
</head>

<body>
@include('sweetalert::alert')
  
    <div class="container">
        <div class="wrapper">
            <h1>Please confirm your email</h1>
            <form action="send-email" method="POST">
                @csrf
               
       
                <button type="submit" >confirm</button>
            </form>
        </div>
    </div>

</body>

</html>
