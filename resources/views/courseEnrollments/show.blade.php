<?php
/**
 * @var \App\CourseEnrollment $enrollment
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header">Lessons</h2>
                    <div class="card-body">
                        <ol>
                            @foreach($enrollment->course->lessons as $lesson)
                                <li>
                                    <a href="{{ route('lessons.show', ['slug' => $enrollment->course->slug, 'number' => $lesson->number]) }}">
                                        {{ $lesson->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <div class="card mt-4" id="stat">
                    <h2 class="card-header">Statistics</h2>
                    <div class="card-body">

                        <p>
                            Your rankings improve every time you answer a question correctly.
                            Keep learning and earning course points to become one of our top learners!
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <ranking-list :ranking="country_ranking" :target_user_id="{{ auth()->id() }}"></ranking-list>
                            </div>
                            <div class="col-md-6">
                                <ranking-list :ranking="world_ranking" :target_user_id="{{ auth()->id() }}"></ranking-list>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
new Vue({
    el: '#stat',
    data: {
        world_ranking: [],
        country_ranking: [],
    },
    created: function () {
        this.getWorldRanking();
        this.getCountryRanking();
    },
    methods: {
        getWorldRanking: function() {
            axios.get('/api/course/{{ $enrollment->course_id }}/ranking')
            .then(response=>{
                this.world_ranking = response.data;
                console.log(this.world_ranking);
            })
            .catch();
        },
        getCountryRanking: function() {
            axios.get('/api/course/{{ $enrollment->course_id }}/country/'+{{ auth()->user()->country->id }}+'/ranking')
            .then(response=>{
                this.country_ranking = response.data;
                console.log(this.country_ranking);
            })
            .catch();
        },

    }

});
</script>
@endpush