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
