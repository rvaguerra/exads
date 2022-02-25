<?php

namespace Rodrigo\Exads\TVSeriesExercise;

use Rodrigo\Exads\Database;

class TVSeries
{
    protected int $id;
    protected string $title;
    protected string $channel;
    protected string $gender;

    public function getId() : int
    {
        return $this->id;
    }

    public function getChannel() : string
    {
        return $this->channel;
    }

    public function getGender() : string
    {
        return $this->gender;
    }

    /**
     * Fetch TVSeries by id number.
     *
     * @param integer $id
     * @return TVSeries|null
     */
    public static function fetchById(int $id) : TVSeries|null
    {
        $statement = Database::getInstance()->prepare(
            "SELECT id, title, channel, gender FROM tv_series WHERE id = ?"
        );
        $statement->execute([$id]);
        $object= $statement->fetchObject(TVSeries::class);
        return $object ? $object : null;
    }

    /**
     * Create a TVSeries.
     *
     * @param string $title
     * @param string $channel
     * @param string $gender
     * @return TVSeries
     */
    public static function create(string $title, string $channel, string $gender) : TVSeries
    {
        Database::getInstance()->prepare(
            "INSERT INTO tv_series (title, channel, gender) VALUES (?, ?, ?);"
        )->execute([
            $title,
            $channel,
            $gender,
        ]);

        return TVSeries::fetchById(
            Database::getInstance()->lastInsertId()
        );
    }

    /**
     * Get the next TVSeries will air.
     *
     * "null" is returned if no results were found.
     *
     * Can be filtered both by a time-date and TV Series title.
     *
     * If a time-date is not provided the current time-date will be considered.
     *
     * Notes:
     * - The filters would probably be better placed in scopes or in a query builder;
     *    Considering the scope of the technical test, it was not developed in that way.
     *
     * @param DateTime|null $dateTime
     * @param string|null $title
     * @return array|null
     */
    public static function nextWillAir(?\DateTime $dateTime = null, ?string $title = null) : array|null
    {
        $dateTime = is_null($dateTime) ? new \DateTime() : $dateTime;
        
        $arguments = [];
        $arguments[] = $dateTime->format('Y-m-d H:i:s');
        
        $titleQuery = '';
        if (!is_null($title)) {
            $titleQuery = " AND tv_series.title = ?";
            $arguments[] = $title;
        }
        
        $queryString = "SELECT tv_series.title, tv_series_intervals.show_time
            FROM tv_series
            INNER JOIN tv_series_intervals
            ON tv_series.id = tv_series_intervals.id_tv_series
            WHERE tv_series_intervals.show_time >= ? {$titleQuery}
            ORDER BY tv_series_intervals.show_time ASC
            LIMIT 1";

        $statement = Database::getInstance()->prepare($queryString);
        $statement->execute($arguments);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }
}
