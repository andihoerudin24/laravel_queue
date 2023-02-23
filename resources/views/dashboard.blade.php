<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<body>
    <div class="w3-container">

        <h2>Progress Bar Labels</h2>
        <div class="w3-light-grey">
            <div id="myBar" class="w3-container w3-blue" style="width:{{$batch->progress()}}%">{{$batch->progress()}}%</div>
        </div><br>

    </div>
</body>
@if (!is_null($batch) && $batch->progress() < 100) 
	<script>
		window.setInterval(('refresh()'),2000);
		function refresh() {
			window.location.reload();	
		}
	</script>
@endif
</html>
