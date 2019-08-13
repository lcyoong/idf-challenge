<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ranking\CourseRanking;
use App\Ranking\WorldRankingQuery;
use App\Ranking\CountryRankingQuery;

class RankingController extends Controller
{
    /**
     * World ranking list by course
     *
     * @param integer $course
     * @return void
     */
    public function worldCourseRanking($course_id)
    {
        return (new CourseRanking(new WorldRankingQuery($course_id)))->list();
    }

    /**
     * Counntry ranking list by course
     *
     * @param integer $course_id
     * @param integer $country_id
     * @return void
     */
    public function countryCourseRanking($course_id, $country_id)
    {
        return (new CourseRanking(new CountryRankingQuery($course_id, $country_id)))->list();
    }
}
