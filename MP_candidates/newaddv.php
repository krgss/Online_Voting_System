<!DOCTYPE html>
<html lang="en">
    <?php require_once 'menu.html';?>
    <head>
        <link rel="stylesheet" href="css/snackbarcss.css">
        <style>
            body{
                background-color: #666666;
                margin: 0;
            }
            table{
                margin: 2% auto;
                color: whitesmoke;
                background-color:  #00264b;
               opacity: 0.9; 
               padding: 10px;
               padding-right: 0px;
            }
            .dyn td{
                height: 100px;
                width: 100px;
            }
            
            
        </style>
 
        <script src="js/inputcheck.js"></script>
    <script src="jquery-1.8.2.js"></script>
    <script src="mfs100-9.0.2.6.js"></script>
    <script>
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
            
        
    function readURL(input) {
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgPerson')
                    .attr('src', e.target.result)
                    
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
        
        </script>
    </head>
    <script>
         function myFunction(disp) {
                 var x = document.getElementById("snackbar");
                x.className = "show";
                x.innerHTML = disp;
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                }
    </script>
    <body> 
        
        <form action="" method="post">
        <table cellpadding="10">
            <tbody>
                <tr>
                    <td><label >UID</label>
    <input type="text" class="form-control" name="vuid" placeholder="UID" pattern="(.){12,12}" title="please enter 12-digit aadhar number" maxlength="12" 
           onkeypress="return onlynumbers(this, event, digitsOnly);" required autofocus/>
                    </td>
                    <td><label >Name</label>
       <input type="text" class="form-control" name="vname" placeholder="Voter Name">
    </td>
                </tr>
                <tr>
                    <td><label >Gender:  </label>
    
    Male <input type="radio" name="vgender" value="m">
    Female <input type="radio"  name="vgender" value="f"></td>
                    <td> <label >Date Of Birth</label>
    <input type="date" class="form-control" name="vdob" ></td>
                </tr>
                <tr>
                    <td>    <label>Upload Image</label>
                        <input type="file" name="vimage" onchange="readURL(this);"></td>
                    <td><label >FingerPrint</label> <input type="textarea" id="txtIsoTemplate" name="fingeriso" hidden="TRUE">
                        <input id="btnCapture" onclick="Capture()" type="button" value="Capture">
                    </td>
                </tr>
                <tr class="dyn">
                    <td><img src="" id="imgPerson" width="145px" height="188px" alt="Your Image" /></td>
                    <td><img id="imgFinger" width="145px" height="188px" alt="Finger Image" />
	</td>
                </tr>
                <tr>
                    <td colspan="2"><label >Address</label>
    <textarea class="form-control" width="400px" name="vaddress" placeholder="Address" style="margin: 0px; width: 500px; height: 80px;">    </textarea></td>
                    
                </tr>
                <tr >
                    <td ><label >Pin Code</label>
                    <input type="text" class="form-control" name="vpincode" placeholder="Pin Code"></td>
                    <td  align="center"><button name="submit">Submit</button></td>
                    
                </tr>
                
                </tr>
                
                </tr>
            </tbody>
        </table>
        </form>
          <div id="snackbar"></div>

    
        <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

//if(isset($_POST['Submit']))  {
       $uid=$_POST['vuid'];
        $name=$_POST['vname'];
        $addr=$_POST['vaddress'];
        $pin=$_POST['vpincode'];
        $dob=$_POST['vdob'];
        $gender=$_POST['vgender'];
        $fingerprint=$_POST['fingeriso'];
        $img=$_POST['vimage'];
        //echo "".$uid." ".$name." ";
        $db=mysqli_connect('localhost','root',null,'onlinevoting' );

        if ($db->connect_error) 
        {
          die("Connection failed: " . $db->connect_error);
        } 
        if($uid <> NULL && $name <> NULL && $dob <> NULL && $gender <> NULL && $pin <> NULL && $fingerprint <> NULL)
        {    
	$sql="INSERT INTO aadhaar values('$uid','$name','$addr','$dob','$gender','$pin','$fingerprint','$img')";

             if(mysqli_query($db, $sql))
             {
                
                $sql="insert into voter values('$uid',0,NULL)";
                if(mysqli_query($db, $sql))
                {
                    echo "<script>myFunction('Voter successfully added!')</script>";  
                }
                else
                {
                echo "<script>myFunction('Something went Wrong!')</script>";   
                }
             }
             else
             {
                echo "<script>myFunction('Something went Wrong!')</script>";   
             }
       }
    else{
          echo "<script>myFunction('Please enter all the details')</script>"; 
       }
    }
?>

</body>
</html>