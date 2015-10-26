<?php

try {
  // Connect to mongodb
  $conn = new MongoClient();
} catch ( MongoConnectionException $e ) {
    exit("Couldn't connect to mongodb, is the \"mongo\" process running?");
}

try {
  $db = $conn->github;
  $cityCounts = $db->cityCounts;

  $num_cities = $cityCounts->find()->count();
  echo "There are ". $num_cities ." in the collection.\n";

 // Use the GutHub Api to retrieve users from every city.
 echo "Listing user counts for all cities.\n";
 foreach ($cityCounts->find() as $city) {
    /* $cityQuery = array(
      'location' => array('$regex' => new MongoRegex('/'.$city.'/'))
    ); */
    echo $city["city"] .": ". $city["num_users"] ."\n";
  }
}
catch (MongoException $e) {
  exit($e->getMessage());
}
