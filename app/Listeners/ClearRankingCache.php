<?php

namespace App\Listeners;

use App\Events\QuizAnswerEvaluated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class ClearRankingCache
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuizAnswerEvaluated  $event
     * @return void
     */
    public function handle(QuizAnswerEvaluated $event)
    {
        $course = $event->quizAnswer->quiz->lesson->course;

        Cache::forget("ranking-{$course->id}");
    }
}
