<html>
    <link rel="stylesheet" href="css/snackbarcss.css">
    <script>
         function myFunction(disp) {
                 var x = document.getElementById("snackbar");
                x.className = "show";
                x.innerHTML = disp;
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                }
    </script>

    <head>
        <style>
            table{
                background-color: #00264b;
                opacity: 0.8;
                color: whitesmoke;
                align-content: center;
                margin: 10% auto;
                font-size: 20px;
            }
            #submit{
                font-size: 20px; 
            }
        </style>
    </head>
    
    <body>
        <?php require_once 'menu.html';?>
        <form action="" method="post">
            <table cellpadding="15">
                <tr>
                    <td>Enter Pincode</td>
                    <td><input type="text" name="pin"></td>
                </tr>
                <tr>
                    <td>Enter Constituency</td>
                    <td><input type="text" name="con"></td>
                </tr>
                <tr><td colspan="2" align="center"><input type="submit" id="submit"></td></tr>
            </table>
        </form>
        <div id="snackbar"></div>
        <?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $pin=$_POST['pin'];
        $con=$_POST['con'];
        if($pin <> NULL && $con <> NULL)
        {
        $db=mysqli_connect('localhost','root',null,'onlinevoting' );

        if ($db->connect_error) 
        {
          die("Connection failed: " . $db->connect_error);
        } 
        $sql="insert into conpin values('$pin','$con')";
        if(mysqli_query($db, $sql))
                {
                    echo "<script>myFunction('Pincode and constituency are  successfully added!')</script>";  
                }
                else
                {
                echo "<script>myFunction('Something went Wrong!')</script>";   
                }
        }
        else{
            echo "<script>myFunction('Please enter all details')</script>"; 
        }        
    }
?>
    </body>
</html>