<?php

include_once('SimCommandConstants.php');

  $delete_id = $_GET['delete_id'];
  $endpoint = $_GET['endpoint'];
  $ch = curl_init();
  $url = "$urlroot/$endpoint/$delete_id";
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
  $putCaseResponseJson = curl_exec($ch);
  $putCaseResponse = json_decode($putCaseResponseJson);
  curl_close($ch);

  ?>