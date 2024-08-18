<html>
    <style>
        table{
            font-size: 20px;
            color: whitesmoke;
            padding: 1px;
            align-content: center;
            margin: 15% auto;
            background-color: #00264b;
            opacity: 0.9;
        }
        #submit1,#submit2{
            font-size: 15px;
        }
    </style>
<?php session_start(); 
require_once 'menu.html';
$DispErr=""; ?>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
    
             $son=$_POST["con"];
             
             $db=mysqli_connect('localhost','root',null,'onlinevoting' );

                  if ($db->connect_error) 
                    {
                      die("Connection failed: " . $db->connect_error);
                    } 
             
                    $sql="SELECT * FROM candidate WHERE constituency='$son'";
                 
                 
              
                 $result=mysqli_query($db,$sql);
                if(isset($_POST['Submit1']))
                    {
                 while ($row = mysqli_fetch_array($result))
                    {   
                        $_SESSION['son']=$son;
                        header('Location:pie.php');
                       //$cont = $row['constituency']; 
                      
                    }
                }
                
                if(isset($_POST['Submit2'])){
                    while ($row = mysqli_fetch_array($result))
                    {   
                        $_SESSION['son']=$son;
                        header('Location:chart.php');
                       //$cont = $row['constituency']; 
                      
                    }
                }
                 
        $db->close();
    }
  ?>
                      
                         
                
<form action="" method="post">
    <table border="0.5" cellpadding="10px">
        <tr>
            <td>Enter Constituency number</td>
            <td><input type="number" name="con"/></td>
        </tr>
        <tr>
        <td align="center"><input type="submit" name="Submit1" value="Pie Chart" id="submit1"/></td>
        <td align="center"><input type="submit" name="Submit2" value="Bar Graph" id="submit2"/></td>
        </tr>
    </table>
   </form>
   </html>     