<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['uid'])){
    header('Location:index.php');
}
?>
<html>
<head>
	<script src="jquery-1.8.2.js"></script>
	<script src="mfs100-9.0.2.6.js"></script>
	<script language="javascript" type="text/javascript">
		
		var quality = 60;
       	var timeout = 10;

		function Capture() 
		{
            try {
                document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                document.getElementById('txtIsoTemplate').value = "";
                var res = CaptureFinger(quality, timeout);
                if (res.httpStaus) 
                {
                    if (res.data.ErrorCode == "0") {
                        document.getElementById('imgFinger').src = "data:image/bmp;base64," + res.data.BitmapData;
                        document.getElementById('txtIsoTemplate').value = res.data.IsoTemplate;
                        document.getElementById("form").submit();
                    }
                }
                else {
                    alert(res.err);
                }
            }
            catch (e) {
                alert(e);
            }
            return false;
        }
    </script>
</head>
<body>
	<form action="match_finger.php" method="post" id="form">
	<br>
  <!--	Enter UID : <input type="text" name="UID"><br><br> -->
	<img id="imgFinger" width="145px" height="188px" alt="Finger Image" /><br><br>
        <input type="textarea" id="txtIsoTemplate" name="fingeriso" hidden="TRUE"><br><br>
	<input id="btnCapture" onclick="return Capture()" type="button" value="Capture"><br><br>
	<!-- <input type="submit" name="submit" value="Submit Data"> -->
	</form>
</body>
</html>