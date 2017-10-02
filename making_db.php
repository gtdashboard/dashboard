<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    </style>
    <script type="text/javascript">
    <script type="text/javascript">
function move() {
    var elem = document.getElementById("progress");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++;
            elem.style.width = width + '%';
        }
    }
}
</script>
</script>
</head>
<body onload="">

<div class="container centered">
  <h2>Please wait while we set up the database.......</h2>
  <div class="progress">
      <div class="progress-bar" onload="move()" role="progressbar" id="progress" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:1%">
      <span class="sr-only">70% Complete</span>
    </div>
  </div>
</div>

</body>
</html>