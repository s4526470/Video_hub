<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company Location</title>
</head>
<body>
    <div class="holder">
        <div class="element">
            <h2>Company Address</h2>
            <p style="color: red;">Room 9808, 9 Sherwood Rd, Toowong QLD 4066 </p>
            <input style="width: 200px; height: 50px; background-color: lightblue;"
                   name="get_location" type="submit" class="button" id="get_location" value="Get My Location">
            <input style="width: 200px; height: 50px; background-color: lightblue;"
                   name="get_location" type="submit" class="button" id="get_company" value="Get Company Location">
        </div>
        <div class="element">
            <div class="map">
                <iframe id="google_map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3539.4958281362424!2d152.99064371533518!3d-27.484951282884552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b915093417a646b%3A0xcda5ea0d3e9e9eed!2sToowong%20Village!5e0!3m2!1sen!2sau!4v1588917488312!5m2!1sen!2sau"
                        width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
    <div><a href="<?php echo base_url('users/index'); ?>">Back to home page</a></div>

    <script>

        var myLocation = function(pos){
            var lat = pos.coords.latitude,
                long = pos.coords.longitude,
                coords = lat + ', ' + long;

            document.getElementById('google_map').setAttribute('src', 'https://maps.google.co.uk?q=' + coords + '&z=18&output=embed');
        }


        document.getElementById('get_location').onclick=function(){
            navigator.geolocation.getCurrentPosition(myLocation);
            return false;
        }

        document.getElementById('get_company').onclick=function(){
            document.getElementById('google_map').setAttribute('src', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3539.4958281362424!2d152.99064371533518!3d-27.484951282884552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b915093417a646b%3A0xcda5ea0d3e9e9eed!2sToowong%20Village!5e0!3m2!1sen!2sau!4v1588917488312!5m2!1sen!2sau');
        }
    </script>
</body>
</html>
