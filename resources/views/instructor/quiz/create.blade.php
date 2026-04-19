@extends('instructor.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">Créer un nouveau quiz</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Informations du quiz</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('instructor.quiz.store', $course->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titre du quiz</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_limit">Limite de temps (en minutes)</label>
                                    <input type="number" class="form-control" id="time_limit" name="time_limit" min="1">
                                    <small class="form-text text-muted">Laissez vide pour aucune limite de temps</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passing_score">Score minimum pour réussir (%)</label>
                                    <input type="number" class="form-control" id="passing_score" name="passing_score" min="1" max="100" value="60" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="is_published" name="is_published">
                                <label class="custom-control-label" for="is_published">Publier immédiatement</label>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Créer le quiz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 