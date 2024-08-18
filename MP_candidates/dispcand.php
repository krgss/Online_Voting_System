<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
           
            img{
                margin-left: 20%;
                margin-right: 20%;
                margin-top: 10%;
                margin-bottom: 10%;
                
                width: 60%;
                height: 180px;
            }
           
        </style>
    </head>
<body>

<div class="w3-sidebar w3-bar-block w3-light-grey w3-card-2" style="width:20%">
  
  <img src="" alt="image" />
  <button class="w3-bar-item w3-button tablink" onclick="dynselection(event, 'Home')">Home</button>
  <button class="w3-bar-item w3-button tablink" onclick="dynselection(event, 'Candidate')">Candidate</button>
  <button class="w3-bar-item w3-button tablink" onclick="dynselection(event, 'Voter')">Voter</button>
  <button class="w3-bar-item w3-button tablink" onclick="dynselection(event, 'Result')">Results</button>
</div>

<div style="margin-left:25%; ">
  
  <div id="Home" class="w3-container oneTab" style="display:none">
    <h2>Home</h2>
  </div>

  <div id="Candidate" class="w3-container oneTab" style="display:none">
      <?php require_once('index.php');
      ?>
  </div>

  <div id="Voter" class="w3-container oneTab" style="display:none">
    <h2>Voter</h2>
          
  
  </div>
<div id="Result" class="w3-container oneTab" style="display:none">
    <h2>Results</h2>
   </div>

</div>

<script>
function dynselection(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("oneTab");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-red", ""); 
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>

</body>
</html>
