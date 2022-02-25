<?php

namespace Rodrigo\Exads\TVSeriesExercise;

use Rodrigo\Exads\Database;

class TVSeriesInterval
{
    protected int $id;
    protected int $id_tv_series;
    protected string $week_day;
    protected string $show_time;

    public function getId() : int
    {
        return $this->id;
    }

    public function getIdTVSeries() : int
    {
        return $this->id_tv_series;
    }

    public function getWeekDay() : string
    {
        return $this->week_day;
    }

    public function getShowTime() : string
    {
        return $this->show_time;
    }

    /**
     * Fetch TVSeriesInterval by id number.
     *
     * @param integer $id
     * @return TVSeriesInterval|null
     */
    public static function fetchById(int $id) : TVSeriesInterval | null
    {
        $statement = Database::getInstance()->prepare(
            "SELECT id, id_tv_series, week_day, show_time FROM tv_series_intervals WHERE id = ?"
        );
        $statement->execute([$id]);
        $object = $statement->fetchObject(TVSeriesInterval::class);
        return $object ? $object : null;
    }

    /**
     * Create a TVSeriesInterval.
     *
     * @param integer $tvSeriesId
     * @param string $showTime
     * @return TVSeriesInterval
     */
    public static function create(int $tvSeriesId, string $showTime) : TVSeriesInterval
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $showTime);
        $weekDay = $dateTime->format('D');

        Database::getInstance()->prepare(
            "INSERT INTO tv_series_intervals (id_tv_series, week_day, show_time) VALUES (?, ?, ?);"
        )->execute([
            $tvSeriesId,
            $weekDay,
            $showTime,
        ]);

        return TVSeriesInterval::fetchById(
            Database::getInstance()->lastInsertId()
        );
    }
}
