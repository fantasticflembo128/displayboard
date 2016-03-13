<?php
  include 'utils.php';
  $conn = getReadConnection();
  $sql = "SELECT Location, AppID FROM Weather";
  $result = $conn->query($sql);
  $row = $result->fetch();
  $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $row['Location'] . "&appid=" . $row['AppID'] . "&units=metric";
  $data = getSslPage($url);
  $json = json_decode($data);
  $weather = $json->weather;
  $main = $json->main;
  $wind = $json->wind;
  $icon = $weather[0]->icon;
  $description = $weather[0]->description;
  $temperature = $main->temp . "°C";
  $windSpeed = $wind->speed . "m/s";
  $windDir = $wind->deg;
  $windDir = number_format($windDir, 0);
  $currentWeather = array(
    "icon" => $icon,
    "description" => $description,
    "temperature" => $temperature,
    "windSpeed" => $windSpeed,
    "windDir" => $windDir
  );
  $url = "http://api.openweathermap.org/data/2.5/forecast?q=" . $row['Location'] . "&appid=" . $row['AppID'] . "&units=metric";
  $data = getSslPage($url);
  $json = json_decode($data);
  $list = $json->list;
  $forecast = array();
  for($i = 0; $i < 3; $i++)
  {
    $result = $list[$i];
    $time = date("h:i", $result->dt);
    $main = $result->main;
    $weather = $result->weather;
    $wind = $result->wind;
    $icon = $weather[0]->icon;
    $description = $weather[0]->description;
    $temperature = $main->temp . "°C";
    $windDir = $wind->speed . "m/s";
    $windDir = $wind->deg;
    $windDir = number_format($windDir, 0);
    $weather = array(
      "time" => $time,
      "icon" => $icon,
      "description" => $description,
      "temperature" => $temperature,
      "windSpeed" => $windSpeed,
      "windDir" => $windDir
    );
    array_push($forecast, $weather);
  }
  $response = array(
    "currentWeather" => $currentWeather,
    "forecast" => $forecast
  );
  echo json_encode($response);
?>
