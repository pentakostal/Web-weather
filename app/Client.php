<?php

namespace App;

class Client
{
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getWeatherNow(?string $cityName): Weather
    {
        $location = $this->getlocation($cityName);
        $apiUrl = 'https://api.openweathermap.org/data/2.5/weather?q=' . $location->getName() . '&appid=' . $this->apiKey . '&units=metric';
        $weatherData = json_decode(file_get_contents($apiUrl), true);
        //var_dump($weatherData);die;
        return new Weather(
            $location->getName(),
            $weatherData['weather'][0]['main'],
            round($weatherData['main']['temp']),
            null,
            null,
            $weatherData['main']['humidity'],
            $weatherData['main']['pressure'],
            round($weatherData['wind']['speed']),
            $weatherData['weather'][0]['icon']
        );
    }

    public function getWeatherAfterTwelveHour(string $cityName): Weather
    {
        $location = $this->getlocation($cityName);
        $apiUrl = 'https://api.openweathermap.org/data/2.5/forecast?q=' . $location->getName() . '&appid=' . $this->apiKey . '&units=metric';
        $weatherData = json_decode(file_get_contents($apiUrl), true);

        return new Weather(
            $location->getName(),
            $weatherData['list'][3]['weather'][0]['main'],
            round($weatherData['list'][3]['main']['temp']),
            null,
            null,
            $weatherData['list'][3]['main']['humidity'],
            $weatherData['list'][3]['main']['pressure'],
            round($weatherData['list'][3]['wind']['speed']),
            $weatherData['list'][3]['weather'][0]['icon']
        );
    }

    public function getForecastForToday(string $cityName): Weather
    {
        $location = $this->getlocation($cityName);
        $apiUrl = 'https://api.openweathermap.org/data/2.5/forecast?q=' . $location->getName() . '&appid=' . $this->apiKey . '&units=metric';
        $weatherData = json_decode(file_get_contents($apiUrl), true);
        $weatherData24 = [];

        for ($i = 0; $i < 8; $i++) {
            $weatherData24[] = $weatherData['list'][$i];
        }

        foreach ($weatherData24 as &$value) {
            $sumWeather[] = (string) $value['weather'][0]['main'];
        }
        $data['weather'] = key(array_count_values(explode(' ', implode(' ', $sumWeather))));

        foreach ($weatherData24 as &$value) {
            $sumMin[] = (float) $value['main']['temp_min'];
        }
        $data['minTemperature'] = round((array_sum($sumMin) / 8));

        foreach ($weatherData24 as &$value) {
            $sumMax[] = (float) $value['main']['temp_max'];
        }
        $data['maxTemperature'] = round((array_sum($sumMax) / 8));

        foreach ($weatherData24 as &$value) {
            $sumHumidity[] = (float) $value['main']['humidity'];
        }
        $data['humidity'] = round((array_sum($sumHumidity) / 8));

        foreach ($weatherData24 as &$value) {
            $sumPressure[] = (float) $value['main']['pressure'];
        }
        $data['pressure'] = round((array_sum($sumPressure) / 8));

        foreach ($weatherData24 as &$value) {
            $sumSpeed[] = (float) $value['wind']['speed'];
        }
        $data['windSpeed'] = (int) round((array_sum($sumSpeed) / 8));

        foreach ($weatherData24 as &$value) {
            $sumIcon[] = (string) $value['weather'][0]['icon'];
        }
        $data['icon'] = key(array_count_values(explode(' ', implode(' ', $sumIcon))));

        return new Weather(
            $location->getName(),
            $data['weather'],
            null,
            $data['minTemperature'],
            $data['maxTemperature'],
            $data['humidity'],
            $data['pressure'],
            $data['windSpeed'],
            $data['icon']
        );
    }
    private function getLocation(string $cityName): Location
    {
        return new Location($cityName);
    }
}