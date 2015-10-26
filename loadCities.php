<?php
/*
 * (C) Copyright 2015 Jerome Meinke and others.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * Contributors:
 *   Jerome Meinke, Freiburg, https://github.com/jmeinke
 */

require_once("config.php");
if (!defined("DEBUG"))
  exit("Error: Configuration constants not found...\n");

// Codes of the countries on the european continent
$eu_codes = array("AL","AD","AT","BY","BE","BA","BG","HR","CY","CZ","DK","EE",
                  "FO","FI","FR","DE","GI","GR","HU","IS","IE","IT","LV","LI",
                  "LT","LU","MK","MT","MD","MC","NL","NO","PL","PT","RO",
                  // "RU",
                  "SM","RS","SK","SI","ES","SE","CH","UA","GB","VA","RS","IM",
                  "RS","ME");

try {
  // Initialize the MongoDB connection
  $conn = new MongoClient();
} catch (MongoConnectionException $e) {
    exit("Couldn't connect to mongodb, is the \"mongo\" process running?\n");
}

try {
  $db = $conn->github;
  $cityCoords = $db->cityCoords;
  $cityCoords->createIndex(array("city_ascii" => 1), array('unique' => true));

  if (DEBUG) {
    echo("All collection entries are being removed...");
    $cityCoords->remove(array());
    echo("done.\n");
  }
}
catch (MongoException $e) {
  exit($e->getMessage());
}

// Read and insert values from tsv file
if ($cityCoords->find()->count() == 0) {
  echo("Loading entries from '".CITIES_TSV."'...\n");
  if (($handle = fopen(CITIES_TSV, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
      // Check if this really is a european city
      if (!in_array($data[4], $eu_codes)) continue;
      // Check if the population count is high enough
      if ($data[5] < POPULATION) continue;
      // Finally insert the city into the database
      try {
        $cityCoords->insert(array(
          "city" => $data[0],
          "city_ascii" => $data[1],
          "latitude" => $data[2],
          "longitude" => $data[3],
          "country_code" => $data[4],
          "population" => $data[5]
        ));
      }
      catch (MongoException $e) {
        echo($e->getMessage()."\n");
      }
    }
    fclose($handle);
  } else {
    exit("Error: Could not open the file '".CITIES_TSV."'.\n");
  }
} else {
  echo("The collection is already populated. This step will be skipped!\n");
}

try{
  $num_cities = $cityCoords->find()->count();
  echo "There are ". $num_cities ." cities in the collection.\n";
} catch (MongoException $e) {
  echo($e->getMessage()."\n");
}
