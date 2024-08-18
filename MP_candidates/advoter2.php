<?php
    //if($_SERVER['REQUEST_METHOD'] == 'POST'){

//if(isset($_POST['Submit']))  {
       $uid=$_POST['vuid'];
        $name=$_POST['vname'];
        $addr=$_POST['vaddress'];
        $pin=$_POST['vpincode'];
        $dob=$_POST['vdob'];
        $gender=$_POST['vgender'];
        $fingerprint=$_POST['fingeriso'];
        //echo "".$uid." ".$name." ";
        $db=mysqli_connect('localhost','root',null,'onlinevoting' );

        if ($db->connect_error) 
        {
          die("Connection failed: " . $db->connect_error);
        } 
	$sql="INSERT INTO adhar values('$uid','$name','$addr','$dob','$gender','$pin','$fingerprint')";

             if(mysqli_query($db, $sql))
             {
                echo "Voter successfully added!";   
             }
             else
             {
                echo "FCUK";   
             }
    //}
    //else{
        //echo "values cannot be empty!";
    //}
    //}
?>

