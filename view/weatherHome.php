<?php
use App\Client;
use Carbon\Carbon;

require_once 'vendor/autoload.php';

$apiKey = "a0d5241d2f9b01766802b3f6a012a7cd";
$apiClient = new Client($apiKey);
$today = Carbon::now();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles.css">
    <title>Weather</title>
</head>
<body>
    <div class="hero-image">
        <p class="date">
            Today date:
            <br><?php echo $today->englishMonth; ?>
            <br><?php echo $today->englishDayOfWeek; ?>&nbsp;&nbsp;&nbsp;<?php echo $today->day; ?>
            <br id="time"><?php echo $today->toTimeString(); ?>
        </p>

        <?php $riga = $apiClient->getWeatherNow("Riga"); ?>
        <h1 class="center">In <?php echo $riga->getCity() ?> city weather now is:</h1>
        <img src="https://openweathermap.org/img/w/<?php echo $riga->getIcon()?>.png" alt="weather image" class="centerImg"/>
        <p class="center">
            <?php echo $riga->getWeather() ?>
            <br>Temperature is <?php echo $riga->getTemperature() ?> celsius
            <br>Humidity is <?php echo $riga->getHumidity() ?> %
            <br>Pressure is <?php echo $riga->getPressure() ?>
            <br>Wind speed is <?php echo $riga->getWindSpeed() ?> m/s
        </p>

        <h2>
            <a href="/city/?city=Riga" >Riga</a>&nbsp;&nbsp;&nbsp;
            <a href="/city/?city=Vilnius" >Vilnius</a>&nbsp;&nbsp;&nbsp;
            <a href="/city/?city=Tallinn" >Tallinn</a>
        </h2>

        <form class="center" action="find/?city=">
            <label for="city">Find city:</label>
            <br>
            <input type="text" id="city" name="city">
            <input type="submit" value="Submit" >
        </form>
    </div>
</body>
</html>