<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orientate</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="cssTest/indexStyle.css" type="text/css" media="screen" id ="estilo">
    <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="js/tms-0.3.js" type="text/javascript"></s3cript>
    <script src="js/tms_presets.js" type="text/javascript"></script>
    <script src="js/jquery.easing.1.3.js" type="text/javascript"></script> 
    <script src="js/events.js" type="text/javascript"> </script>
    <script type="text/javascript">
        if (screen.width < 1280 ) {
            $("#estilo").attr("href", "cssTest/indexStyle.css");
        }
            else if (screen.width >=1280 && screen.width <1920 ) {
                $("#estilo").attr("href", "css1280/indexStyle.css");
            }
            else if (screen.width >= 1920 ) {
                $("#estilo").attr("href", "css1920/indexStyle.css");
            }
    </script>

</head>
<body>
	
    
	<!-------------------- Main Content --------------------> 


                <div class="main">

                </div>
   
    <!-------------------- Footer --------------------> 

    <footer>

    </footer>

</body>
</html>
