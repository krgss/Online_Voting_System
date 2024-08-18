<html>
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$mydb = "onlinevoting";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully\n"; 
    
    $uid = $_SESSION["uid"];
    
   $fingerprint = $_POST["fingeriso"];
    
    $result = $conn->query("SELECT fingerprint FROM aadhaar where uid = '$uid'"); 
    // set the resulting array to associative
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $ans=$result->fetch()['fingerprint'];
    // echo $ans;
     //echo "\n".$fingerprint;
    }
catch(PDOException $e)
    {
         echo "\nConnection failed: " . $e->getMessage();
    }

echo "
<head>
<script src='jquery-1.8.2.js'></script>
<script src='mfs100-9.0.2.6.js'></script>
<script type='text/javascript'>

    function Verify() 
        {
            try 
            {
                var res = VerifyFinger('$ans ', '$fingerprint');

                if (res.httpStaus) 
                {
                    if (res.data.Status) 
                    {
                        location.href='menu.html';
                    }
                    
                    else 
                    {
                        if (res.data.ErrorCode != '0') 
                        {
                            alert(res.data.ErrorDescription);
                        }
                        
                        else 
                        {
                            location.href='home.php';
                            alert('Finger not matched');
                        }
                    }
                }
                else 
                {
                    alert(res.err);
                }
            }
            catch (e) {
                alert(e);
            }
            return false;
        }
    Verify();

</script>
</head>";
?>
    
</html>