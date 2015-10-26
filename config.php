<?php

// Timezone setting
date_default_timezone_set('Europe/Berlin');

// Debug mode
define('DEBUG', true);

// The tab-separated values file for city coordinates
define('CITIES_TSV', "data/cities15000-stripped.tsv");

// The output file (geo json)
define('GEO_JSON_FILE', "data/github-europe.js");

// This is the minimum population count for a city to be queried
define('POPULATION', 150000);

// Only find users with more than REPO_NUM repositories
define('REPO_NUM', 1);

// GitHub authentication user
// define('AUTH_USER', "");

// GitHub authentication password
// define('AUTH_PW', "");

?>
