<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="form_action.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script>
function test()
{
    var p=document.getElementById("project").value;
    console.log(p);
    var dataString = 'project='+p;
    console.log(dataString);
    $.ajax({beforeSend: function(){
			},
	type: "POST",
	url: "create/create2.php",
	data:dataString,
	success: handleData
	});
}
function handleData(data)
{
    if(data.length>1)
    {
        console.log(data.length);
        console.log(data);
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv2").style.display = "block";
    }
    console.log(data);
}
function showPage() {
  document.getElementById("loader").style.display = "block";
  document.getElementById("myDiv").style.display = "none";
  test();
  
}
</script>
<style>
    .centered {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transform: -webkit-translate(-50%, -50%);
  transform: -moz-translate(-50%, -50%);
  transform: -ms-translate(-50%, -50%);
}
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from { bottom:-100px; opacity:0 } 
  to { bottom:0; opacity:1 }
}

#myDiv {
  display: block;
  text-align: center;
}
#myDiv2 {
  display: none;
  text-align: center;
}
</style>
</head>
<body>
    <div class="centered" id="myDiv">
    <div class="container" style="margin-top:10%;text-align:center;">
        <h1 style="font-weight:bold;font-size: 50px;">SPECIAL PROJECTS</h1>
    </div>
    <div class="container" id="box" style="margin-top:5%;text-align:center;">
        <form action="create/db_create_cpanel.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Project Number eg:106,107...." maxlength="3" style="margin-top:10px;text-align:center;" name="project" id="project"/>
                <button  class="btn btn-primary" style="width:100%;margin-top: 10px;">Setup A New Project</button>
            </div>
        </form>
    </div>
    <div id="error" class="container"></div>
    </div>
    <div class="centered" id="myDiv2">
    <div class="container" style="margin-top:10%;text-align:center;">
        <h1 style="font-weight:bold;font-size: 50px;">Successful</h1>
    </div>
    </div>
    <div id="loader" style="display: none"></div>
</body>
</html>

