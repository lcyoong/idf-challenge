<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ranking\CourseRanking;
use App\Ranking\WorldRankingQuery;

class RankingController extends Controller
{
    public function worldCourseRanking($course)
    {
        return (new CourseRanking(new WorldRankingQuery($course)))->list();
    }
}
