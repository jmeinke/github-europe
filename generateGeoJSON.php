<?php

// This is the project configuration
require_once("config.php");
if (!defined("DEBUG"))
  exit("Error: Configuration constants not found...\n");

try {
  // Initialize the MongoDB connection
  $conn = new MongoClient();
} catch ( MongoConnectionException $e ) {
    exit("Couldn't connect to mongodb, is the \"mongo\" process running?\n");
}

try {
  $db = $conn->github;
  $cityCoords = $db->cityCoords;

  $num_cities = $cityCoords->find()->count();
  echo "There are ". $num_cities ." cities in the collection.\n";
}
catch (MongoException $e) {
  exit($e->getMessage());
}

try {
  $geoInfo = array();

  echo "Listing user counts for all cities.\n";
  foreach ($cityCoords->find() as $city) {
    if (isset($city["gh_total_count"]) && $city["gh_total_count"] > 0) {
      $tc = $city["gh_total_count"];

      $i = 0;
      $topCityUsers = "Top ten users: <br/>";
      $users = $city["gh_users"];
      // usort($users, "sort_by_rank");
      foreach ($users as $user) {
        if ($i > 9) break;
        $topCityUsers .= "<div class=\"gh_profile\">"
            ."<img src=\"".$user["avatar_url"]."\" />"
            ."<a href=\"".$user["html_url"]."\">"
            .strip_tags($user["login"])
            ."</a>
          </div>";
        $i++;
      };
      $topCityUsers .= "</ul>";
      $lat = floatval($city["latitude"]);
      $lng = floatval($city["longitude"]);
      echo $city["city_ascii"] .": ". $tc .": ". $lat .": ". $lng ."\n";
      $geoInfo[] = array(
        "id" => $city["_id"]->__toString(),
        "type" => "Feature",
        "properties" => array(
            "title" => $tc ." in ".$city["city_ascii"],
            "description" => $topCityUsers,
            "radius" => 5 + (int)(log($tc) * ($tc / 8000))
        ),
        "geometry" => array(
              "type" => "Point",
              "coordinates" => array(
                  $lng,
                  $lat
              )
          )
      );
    }
  }

  $geoJSON = array(
    "type" => 'FeatureCollection',
    "features" => $geoInfo
  );
  $geoJSON = json_encode($geoJSON, JSON_PRETTY_PRINT);

  // Write the geo information to a file
  $jsFile = fopen(GEO_JSON_FILE, 'w+');
  fwrite($jsFile, "var europe_info = ". $geoJSON .";\n");
  fclose($jsFile);
}
catch (MongoException $e) {
  exit($e->getMessage()."\n");
}

/*
function sort_by_rank($u1, $u2) {
    return $u1["rank"] > $u2["rank"];
}
*/
