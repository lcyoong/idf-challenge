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
                                <ranking-list :ranking="country_ranking" :target_user_id="{{ auth()->id() }}" :rank_category="'in {{ auth()->user()->country->name }}'"></ranking-list>
                            </div>
                            <div class="col-md-6">
                                <ranking-list :ranking="world_ranking" :target_user_id="{{ auth()->id() }}" :rank_category="'Worldwide'"></ranking-list>
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
const course_id = {!! $enrollment->course_id !!};
const country_id = {!! auth()->user()->country->id !!};
</script>
<script src="{{ asset(mix('js/get_ranking.js')) }}"></script>
@endpush