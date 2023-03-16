<?php
// Get user's address information from the user table
function find_user_address_by_id($user_id)
{
  global $connection;

  $stmt = $connection->prepare("SELECT street_1, street_2, city, state_abbrev, zip_code FROM user WHERE user_id = ?");
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $stmt->bind_result($street_1, $street_2, $city, $state_abbrev, $zip_code);
  $stmt->fetch();
  $stmt->close();

  return array(
    'street_1' => $street_1,
    'street_2' => $street_2,
    'city' => $city,
    'state_abbrev' => $state_abbrev,
    'zip_code' => $zip_code,
  );
}
