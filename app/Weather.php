<?php

namespace App;

class Weather
{
    private string $city;
    private string $weather;
    private ?int $temperature;
    private ?int $minTemperature;
    private ?int $maxTemperature;
    private int $humidity;
    private int $pressure;
    private float $windSpeed;
    private string $icon;

    public function __construct(
        string $city,
        string $weather,
        ?int $temperature,
        ?int $minTemperature,
        ?int $maxTemperature,
        int $humidity,
        int $pressure,
        float $windSpeed,
        string $icon
    )
    {
        $this->city = $city;
        $this->weather = $weather;
        $this->temperature = $temperature;
        $this->minTemperature = $minTemperature;
        $this->maxTemperature = $maxTemperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->icon = $icon;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getWeather(): string
    {
        return $this->weather;
    }

    public function getTemperature(): int
    {
        return $this->temperature;
    }

    public function getMinTemperature(): int
    {
        return $this->minTemperature;
    }

    public function getMaxTemperature(): int
    {
        return $this->maxTemperature;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }
}