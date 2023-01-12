
### Exads | PHP Senior Technical Test

---

Hello!

To make it easier, the code that solves each question was placed inside a static method named exercise found at the related question class.

Considering this is a technical test, the code is as simple as possible:
* No front-end was implemented;
* No dependencies (other than phpunit for testing and exads/ab-test-data);
* All classes were implemented from scratch.

A few tests were made and placed inside the test folder.

I used `PHP 8.1.3`, but it should work with older versions.

For database connections: `PDO`. MySQL (InnoDB) as driver.

Please check `src/index.php` before running:
* The PDO connection for the database question needs to be updated so the code can connect to the database (no .env system used);
* The database name can be modified;
* The database is setup automatically. As requested, the code to create the database tables can be found at 'TVSeriesExercise' class.

Running the code through console:

```
php src/index.php
```

---

As of the test:

1. Prime Numbers

Write a PHP script that prints all integer values from 1 to 100.
Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
only multiple of itself then print “[PRIME]”.

2. ASCII Array

Write a PHP script to generate a random array containing all the ASCII characters from comma (“,”) to
pipe (“|”). Then randomly remove and discard an arbitrary element from this newly generated array.
Write the code to efficiently determine the missing character.

3. TV Series

Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:

```
tv_series -> (id, title, channel, gender);
tv_series_intervals -> (id_tv_series, week_day, show_time);
```

*Provide the SQL scripts that create and populate the DB*

Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
inputted time-date, and that can be optionally filtered by TV Series title.

4. A/B Testing

Exads would like to A/B test some promotional designs to see which provides the best conversion rate.

Write a snippet of PHP code that redirects end users to the different designs based on the data
provided by this library: *packagist.org/exads/ab-test-data*.

The data will be structured as follows:

```php
“promotion” => [
    “id” => 1,
    “name” => “main”,
    “designs” => [
        [ “designId” => 1, “designName” => “Design 1”, “splitPercent” => 50 ],
        [ “designId” => 2, “designName” => “Design 2”, “splitPercent” => 25 ],
        [ “designId” => 3, “designName” => “Design 3”, “splitPercent” => 25 ],
    ]
]
```

The code needs to be object-oriented and scalable. The number of designs per promotion may vary.

---

I hope you like it =)

