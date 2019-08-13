<?php declare(strict_types=1);

namespace App\Ranking;

use Illuminate\Database\Eloquent\Collection;

interface RankingQueryInterface
{
    // Filter the query
    public function filter(): RankingQueryInterface;

    // Perform joins on query
    public function joins(): RankingQueryInterface;

    // Group and aggregate function
    public function groupBy(): RankingQueryInterface;

    // Bind and execute the query
    public function get(): Collection;
}
