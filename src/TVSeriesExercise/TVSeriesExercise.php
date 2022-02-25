<?php

namespace Rodrigo\Exads\TVSeriesExercise;

use Rodrigo\Exads\Database;
use Rodrigo\Exads\TVSeriesExercise\TVSeries;

class TVSeriesExercise
{
    /**
     * Setup the database for the TVSeries exercise.
     *
     * @return void
     */
    public static function setup(string $databaseName) : void
    {
        TVSeriesExercise::createDatabase($databaseName);
        TVSeriesExercise::createTables();
        TVSeriesExercise::populate();
    }

    /**
     * Create exercise database.
     *
     * No SQL injection protection considering the exercise scope.
     *
     * The database would not be created this way in production.
     *
     * @param string $databaseName
     * @return void
     */
    protected static function createDatabase(string $databaseName) : void
    {
        $db = Database::getInstance();

        $db->prepare("DROP DATABASE IF EXISTS {$databaseName}")->execute();
        $db->prepare("CREATE DATABASE {$databaseName}")->execute();
        $db->prepare("USE {$databaseName}")->execute();
    }

    /**
     * Create exercise tables.
     *
     * @return void
     */
    protected static function createTables() : void
    {
        $db = Database::getInstance();

        $db->query("DROP TABLE IF EXISTS tv_series;");
        $db->query("CREATE TABLE tv_series (
            id INT AUTO_INCREMENT KEY,
            title TEXT,
            channel TEXT,
            gender TEXT
        );");

        $db->query("DROP TABLE IF EXISTS tv_series_intervals;");
        $db->query("CREATE TABLE tv_series_intervals (
            id INT AUTO_INCREMENT KEY,
            id_tv_series INT,
            week_day TEXT,
            show_time DATETIME
        );");
    }

    /**
     * Populate the database.
     *
     * @return void
     */
    protected static function populate() : void
    {
        $tvSeriesList = [
            [
                'title' => 'TV Series A',
                'channel' => 'Channel A',
                'gender' => 'Gender A',
                'intervals' => [
                    '2022-03-10 08:00:00',
                    '2022-03-11 08:00:00',
                    '2022-03-12 08:00:00',
                    '2022-03-13 08:00:00',
                    '2022-03-14 08:00:00',
                ],
            ],
            [
                'title' => 'TV Series B',
                'channel' => 'Channel B',
                'gender' => 'Gender B',
                'intervals' => [
                    '2022-03-10 10:00:00',
                    '2022-03-11 10:00:00',
                ],
            ],
            [
                'title' => 'TV Series C',
                'channel' => 'Channel C',
                'gender' => 'Gender C',
                'intervals' => [
                    '2022-03-12 09:00:00',
                    '2022-03-19 09:00:00',
                ],
            ],
        ];

        foreach ($tvSeriesList as $aTVSeries) {
            $tvSeries = TVSeries::create(
                $aTVSeries['title'],
                $aTVSeries['channel'],
                $aTVSeries['gender']
            );

            $intervals = $aTVSeries['intervals'];

            foreach ($intervals as $interval) {
                TVSeriesInterval::create($tvSeries->getId(), $interval);
            }
        }
    }

    /**
     * A code that tells when the next TV Series will air, filtered optionally by
     * time-date and TV Series title.
     *
     * @return void
     */
    public static function exercise(): void
    {
        echo "\n\nTV Series Exercise\n\n";

        $dateTimeFilter = \DateTime::createFromFormat(
            'Y-m-d H:i:s',
            '2022-03-28 00:00:00'
        );
        $titleFilter = '';
        print_r(TVSeries::nextWillAir($dateTimeFilter));
    }
}
