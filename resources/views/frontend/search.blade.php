@extends('frontend.master')

@section('title')
    Résultats de recherche pour "{{ $search }}"
@endsection

@section('content')
<div class="container mt-4">
    <h2>Résultats de recherche pour "{{ $search }}"</h2>
    
    @if($courses->count() > 0)
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($course->course_image)
                            <img src="{{ asset($course->course_image) }}" class="card-img-top" alt="{{ $course->course_name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->course_name }}</h5>
                            <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                            <a href="{{ route('course.view', $course->id) }}" class="btn btn-primary">Voir le cours</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Aucun cours trouvé pour "{{ $search }}"
        </div>
    @endif
</div>
@endsection 