<?php

use App\Client;
use Carbon\Carbon;

require_once 'vendor/autoload.php';

$apiKey = "a0d5241d2f9b01766802b3f6a012a7cd";
$apiClient = new Client($apiKey);

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

    <h2>
        <a href="/city/?city=Riga" >Riga</a>&nbsp;&nbsp;&nbsp;
        <a href="/city/?city=Vilnius" >Vilnius</a>&nbsp;&nbsp;&nbsp;
        <a href="/city/?city=Tallinn" >Tallinn</a>
    </h2>

    <form class="center" action="/find/?city=">
        <label for="city">Find city:</label>
        <br>
        <input type="text" id="city" name="city">
        <input type="submit" value="Submit">
    </form>

    <?php $weather = $apiClient->getWeatherNow($_GET['city'] ?? 'Riga'); ?>
    <h1>In <?php echo $weather->getCity() ?> city weather now is:</h1>
    <div class="weather-icon"><img src="https://openweathermap.org/img/w/<?php echo $weather->getIcon()?>.png" /></div>
    <p>
        <?php echo $weather->getWeather() ?>
        <br>Temperature is <?php echo $weather->getTemperature() ?> celsius
        <br>Humidity is <?php echo $weather->getHumidity() ?> %
        <br>Pressure is <?php echo $weather->getPressure() ?>
        <br>Wind speed is <?php echo $weather->getWindSpeed() ?> m/s
    </p>

    <?php $weather = $apiClient->getWeatherAfterTwelveHour($_GET['city'] ?? 'Riga'); ?>
    <h1>Forecast after 12 hours in <?php echo $weather->getCity() ?> city:</h1>
    <div class="weather-icon"><img src="http://openweathermap.org/img/w/<?php echo $weather->getIcon()?>.png" /></div>
    <p>
        <br><?php echo $weather->getWeather() ?>
        <br>Temperature is <?php echo $weather->getTemperature() ?> celsius
        <br>Humidity is <?php echo $weather->getHumidity() ?> %
        <br>Pressure is <?php echo $weather->getPressure() ?>
        <br>Wind speed is <?php echo $weather->getWindSpeed() ?> m/s
    </p>

    <?php $weather = $apiClient->getForecastForToday($_GET['city'] ?? 'Riga'); ?>
    <h1>Forecast for today in <?php echo $weather->getCity() ?> city:</h1>
    <div class="weather-icon"><img src="http://openweathermap.org/img/w/<?php echo $weather->getIcon()?>.png" /></div>
    <p>
        <br><?php echo $weather->getWeather() ?>
        <br>Min temperature is <?php echo $weather->getMinTemperature() ?> celsius
        <br>Max temperature is <?php echo $weather->getMaxTemperature() ?> celsius
        <br>Humidity is <?php echo $weather->getHumidity() ?> %
        <br>Pressure is <?php echo $weather->getPressure() ?>
        <br>Wind speed is <?php echo $weather->getWindSpeed() ?> m/s
    </p>
</div>
</body>
</html>
