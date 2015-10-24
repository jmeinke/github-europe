File origins
------------

[cities15000-stripped.tsv](cities15000-stripped.tsv) is a modified version of [cities15000.txt](http://download.geonames.org/export/dump/cities15000.zip),
which comes from [geonames.org](http://download.geonames.org). The [README](http://download.geonames.org/export/dump/readme.txt) states
that it is licensed under a [Creative Commons Attribution 3.0 License](http://creativecommons.org/licenses/by/3.0/).
The Data is provided "as is" without warranty or any representation of accuracy, timeliness or completeness.
The columns of the file are the following:

Columns       | Description
------------- | -----------
name          | name of geographical point (utf8) varchar(200)
asciiname     | name of geographical point in plain ascii characters, varchar(200)
latitude      | latitude in decimal degrees (wgs84)
longitude     | longitude in decimal degrees (wgs84)
population    | bigint (8 byte int)

[countriesToCities.json](countriesToCities.json) actually comes from [David-Haim/CountriesToCitiesJSON](
https://github.com/David-Haim/CountriesToCitiesJSON/blob/master/countriesToCities.json).
No license information was provided for that file and I don't know how the data
was generated or where it comes from.
