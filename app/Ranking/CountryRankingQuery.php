<?php declare(strict_types=1);

namespace App\Ranking;

class CountryRankingQuery extends WorldRankingQuery
{
    protected $country;

    public function __construct($course, $country)
    {
        $this->country = $country;

        parent::__construct($course);
    }

    public function filter(): RankingQueryInterface
    {
        $this->query->where('course_id', '=', $this->course)->where('country_id', '=', $this->country);

        return $this;
    }
}
