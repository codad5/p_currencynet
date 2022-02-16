<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="" id="result"></div>
    
</body>
<script>
    var source = new EventSource("demo_sse.php");
    source.onmessage = function(event) {
    document.getElementById("result").innerHTML += event.data + "<br>";
    };
</script>
</html>