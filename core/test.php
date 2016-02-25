<html>
<body>
<?php session_start();?>
<button onclick="myFunction()">Try it</button>

<p id="delete"></p>

<script>
function myFunction() {
    var person = prompt("Are you sure you want to delete your account?", "type Yes");
    
    if (person == "Yes") {
        document.getElementById("delete").innerHTML =":(";
      <?php session_unset();
            session_destroy();
            header("Location: myHallsLog");?>
    }
}
</script>
</body>
</html>