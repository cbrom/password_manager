<!doctype html>
<html lang="en">

<body>
  <h1>Hello World!</h1>
  <span id="js-greeting"></span>
  <button onclick="delayedGreeting();">Say hello</button>
</body>

<script>
  function showGreeting(){
    document.getElementById("js-greeting").innerHTML = "Hello JavaScript!"
  }

  function delayedGreeting(){
    window.setTimeout(showGreeting, 1000);
  }
</script>

</html>