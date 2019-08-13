<?php declare(strict_types=1);

namespace App\Ranking;

use App\QuizAnswer;
use DB;
use Illuminate\Database\Eloquent\Collection;

class WorldRankingQuery implements RankingQueryInterface
{
    protected $query;
    protected $course;

    public function __construct($course)
    {
        $this->course = $course;
        
        $this->query = QuizAnswer::select(DB::raw('user_id, users.name, course_id, sum(score) as points'));
    }

    public function filter(): RankingQueryInterface
    {
        $this->query->where('course_id', '=', $this->course);

        return $this;
    }

    public function joins(): RankingQueryInterface
    {
        $this->query->join('quizzes', 'quizzes.id', 'quiz_id')->join('lessons', 'lessons.id', 'lesson_id')->join('users', 'users.id', 'user_id');
        
        return $this;
    }

    public function groupBy($group = null): RankingQueryInterface
    {
        $this->query->groupBy($group ?? ['user_id', 'users.name', 'course_id'])->orderByRaw('sum(score) desc');

        return $this;
    }

    public function get(): Collection
    {
        $this->joins()->filter()->groupBy();

        return $this->query->get();
    }
}
