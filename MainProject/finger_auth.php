<!DOCTYPE html>
<html>
    <head>
	<script src="jquery-1.8.2.js"></script>
	<script src="mfs100-9.0.2.6.js"></script>
	<script language="javascript" type="text/javascript">
		
        var quality = 60;
       	var timeout = 10;
        var template1;
	function Capture() 
        {
            try 
            {
                document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                var res = CaptureFinger(quality, timeout);
                if (res.httpStaus) 
                {
                    if (res.data.ErrorCode == "0") 
                    {
                        document.getElementById('imgFinger').src = "data:image/bmp;base64," + res.data.BitmapData;
                        template1 = res.data.IsoTemplate;
                    }
                }
                else 
                {
                    alert(res.err);
                }
            }
            catch (e) 
            {
                alert(e);
            }
            return false;
        }
        
      /*  function Verify() 
        {
            
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $mydb = "onlinevoting";

            try 
            {
                $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $uid = $_SESSION["uid"];
                $result = $conn->query("SELECT fingerprint FROM aadhaar where uid = '$uid'"); 
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $ans=$result->fetch()['fingerprint'];
            }
            catch(PDOException $e)
            {
                echo "\nConnection failed: " . $e->getMessage();
            }

            ?>
            try 
            {
                var res = VerifyFinger( <?php echo"$ans";?>, template1);

                if (res.httpStaus) 
                {
                    if (res.data.Status) 
                    {
                        alert('Finger matched');
                    }
                    
                    else 
                    {
                        if (res.data.ErrorCode != '0') 
                        {
                            alert(res.data.ErrorDescription);
                        }
                        
                        else 
                        {
                            alert('Finger not matched');
                        }
                    }
                }
                else 
                {
                    alert(res.err);
                }
            }
            catch (e) 
            {
                alert(e);
            }
            return false;
        }
        */
    </script>
</head>
<body>
	<form>
	<br>
	Enter UID : <input type="text" name="UID"><br><br>
	<img id="imgFinger" width="145px" height="188px" alt="Finger Image" /><br><br>
	<input id="btnCapture" onclick="return Capture()" type="button" value="Capture"><br><br>
        <input type="button" onclick="" name="match" value="Verify" onclick="return Verify()">
	</form>
</body>
</html>