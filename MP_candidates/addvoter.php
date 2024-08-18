<!DOCTYPE html>
<html lang="en">
    <head>
  <title>Online Voting System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" src="css/snakbarcss.css">
  <style>
      .panel{
          margin-left: 20px;
          margin-top: 15px;
          width: 600px;
          
      }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

    <!--       
    -->
    <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Add voters</h3>
  </div>
  <div class="panel-body">
     
<form action="advoter2.php" class="form-horizontal" method="POST">
 
  <div class="form-group">
    <label >UID</label>
    <input type="text" class="form-control" name="vuid" placeholder="UID" >

  </div>
  <div class="form-group">
    <label >Name</label>
       <input type="text" class="form-control" name="vname" placeholder="Voter Name">
           
  </div>
  <div class="form-group">
    <label >Address</label>
    <textarea class="form-control" name="vaddress" placeholder="Address" >
    </textarea>
  </div> 
  <div class="form-group">
    <label>Pin Code</label>
    <input type="text" class="form-control" name="vpincode" placeholder="Pin Code">
  </div>
  <div class="form-group">
    <label >Gender</label><br>
    
    Male <input type="radio" name="vgender" value="m">
    Female <input type="radio"  name="vgender" value="f">
  </div>
  <div class="form-group">
    <label >Date Of Birth</label>
    <input type="date" class="form-control" name="vdob" >
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Upload Image</label>
    <input type="file" name="vimage">
    <p class="help-block">upload only .png or .jpg format</p>
  </div>
  <div>
        <img id="imgFinger" width="145px" height="188px" alt="Finger Image" /><br>
        <input type="textarea" id="txtIsoTemplate" name="fingeriso" hidden="TRUE">
	<input id="btnCapture" onclick="return Capture()" type="button" value="Capture">
  </div>
  <button type="submit" class="btn btn-default">Add Voter</button>
</form>
  </div>
</div>
    
    
          <div id="snackbar"></div>

    </body>
    
      
</html>
