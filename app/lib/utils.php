<?php

function getAddressFromLatLng($latlng)
{
  $latlng = str_replace(' ', '', $latlng);
  list($latitude, $longitude) = explode(',', $latlng);

  $apiKey = 'a7d3b5cdd5034c12ad0c2728c22830b8';

  $url = "https://api.opencagedata.com/geocode/v1/json?q={$latitude}+{$longitude}&key={$apiKey}";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    curl_close($ch);
    return 'Error CURL: ' . curl_error($ch);
  }

  curl_close($ch);

  $responseArray = json_decode($response, true);

  if (isset($responseArray['results'][0]['formatted']) && !empty($responseArray['results'][0]['formatted'])) {
    return $responseArray['results'][0]['formatted'];
  } else {
    return 'Alamat tidak ditemukan - ' . $response;
  }
}
