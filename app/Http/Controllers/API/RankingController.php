<?php declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ranking\CourseRanking;
use App\Ranking\WorldRankingQuery;
use App\Ranking\CountryRankingQuery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class RankingController extends Controller
{
    /**
     * World ranking list by course
     *
     * @param integer $course
     * @return void
     */
    public function worldCourseRanking($course_id): Collection
    {
        return  Cache::remember("ranking-$course_id", 90, function () use ($course_id) {
            return (new CourseRanking(new WorldRankingQuery($course_id)))->list();
        });
    }

    /**
     * Counntry ranking list by course
     *
     * @param integer $course_id
     * @param integer $country_id
     * @return void
     */
    public function countryCourseRanking($course_id, $country_id): Collection
    {
        return Cache::remember("ranking-$course_id-$country_id", 90, function () use ($course_id, $country_id) {
            return (new CourseRanking(new CountryRankingQuery($course_id, $country_id)))->list();
        });
    }
}
