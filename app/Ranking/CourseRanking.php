<?php declare(strict_types=1);

namespace App\Ranking;

use Illuminate\Database\Eloquent\Collection;

class CourseRanking
{
    protected $query;
    
    public function __construct(RankingQueryInterface $query)
    {
        $this->query = $query;
    }

    /**
     * Get ranking list
     *
     * @return Collection
     */
    public function list(): Collection
    {
        $result = $this->query->get();

        return $this->formatResult($result);
    }

    /**
     * Format ranking list result before responding - to include position and co-ranks
     *
     * @param [type] $result
     * @return Collection
     */
    public function formatResult($result): Collection
    {
        $last_score = null;
        $last_rank = null;
    
        foreach ($result as $key => $rank) {
            if ($last_score == $rank->points) {
                $rank->position = $last_rank;
            } else {
                $rank->position = $key + 1;
            }
                
            $last_score = $rank->points;
            $last_rank = $rank->position;
        }
    
        return $result;
    }
}
