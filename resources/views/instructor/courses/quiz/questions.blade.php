@extends('instructor.instructor_dashboard')

@section('instructor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('instructor.dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('all.course') }}">Cours</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('course.quizzes', $course->id) }}">Quiz</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Questions du quiz
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Questions du quiz: {{ $quiz->title }}</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                    Ajouter une question
                </button>
            </div>

            @if($quiz->questions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="50%">Question</th>
                                <th>Type</th>
                                <th>Points</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quiz->questions as $question)
                            <tr>
                                <td>{{ $question->question_text }}</td>
                                <td>
                                    @if($question->question_type == 'multiple_choice')
                                        Choix multiple
                                    @elseif($question->question_type == 'true_false')
                                        Vrai/Faux
                                    @else
                                        Réponse courte
                                    @endif
                                </td>
                                <td>{{ $question->points }}</td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <button type="button" 
                                                class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editQuestionModal{{ $question->id }}"
                                                title="Modifier">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <form action="{{ route('delete.quiz.question', $question->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')"
                                                    title="Supprimer">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center p-4">
                    <p>Aucune question n'a encore été ajoutée à ce quiz.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Question Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.quiz.question', [$course->id, $quiz->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="question_text" class="form-label">Question</label>
                        <textarea class="form-control @error('question_text') is-invalid @enderror"
                                  id="question_text"
                                  name="question_text"
                                  rows="3"
                                  required></textarea>
                        @error('question_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="question_type" class="form-label">Type de question</label>
                        <select class="form-select @error('question_type') is-invalid @enderror"
                                id="question_type"
                                name="question_type"
                                required>
                            <option value="multiple_choice">Choix multiple</option>
                        </select>
                        @error('question_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="options_container">
                        <div class="mb-3">
                            <label class="form-label">Options de réponse</label>
                            <div class="options">
                                <div class="mb-2 option-item">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="radio" name="correct_answer" value="0" required>
                                        </div>
                                        <input type="text" class="form-control" name="options[]" placeholder="Option 1" required>
                                    </div>
                                </div>
                                <div class="mb-2 option-item">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="radio" name="correct_answer" value="1" required>
                                        </div>
                                        <input type="text" class="form-control" name="options[]" placeholder="Option 2" required>
                                    </div>
                                </div>
                                <div class="mb-2 option-item">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="radio" name="correct_answer" value="2" required>
                                        </div>
                                        <input type="text" class="form-control" name="options[]" placeholder="Option 3" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="points" class="form-label">Points</label>
                        <input type="number"
                               class="form-control @error('points') is-invalid @enderror"
                               id="points"
                               name="points"
                               value="1"
                               min="1"
                               required>
                        @error('points')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($quiz->questions as $question)
<!-- Edit Question Modal -->
<div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update.quiz.question', $question->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_question_text{{ $question->id }}" class="form-label">Question</label>
                        <textarea class="form-control"
                                  id="edit_question_text{{ $question->id }}"
                                  name="question_text"
                                  rows="3"
                                  required>{{ $question->question_text }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_question_type{{ $question->id }}" class="form-label">Type de question</label>
                        <select class="form-select"
                                id="edit_question_type{{ $question->id }}"
                                name="question_type"
                                required>
                            <option value="multiple_choice" {{ $question->question_type == 'multiple_choice' ? 'selected' : '' }}>
                                Choix multiple
                            </option>
                            <option value="true_false" {{ $question->question_type == 'true_false' ? 'selected' : '' }}>
                                Vrai/Faux
                            </option>
                            <option value="short_answer" {{ $question->question_type == 'short_answer' ? 'selected' : '' }}>
                                Réponse courte
                            </option>
                        </select>
                    </div>

                    <div class="edit-options-container">
                        <div class="mb-3">
                            <label class="form-label">Options de réponse</label>
                            <div class="options">
                                @foreach($question->options as $index => $option)
                                <div class="mb-2">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="radio" 
                                                   name="correct_answer" 
                                                   value="{{ $index }}"
                                                   {{ $option->is_correct ? 'checked' : '' }}
                                                   required>
                                        </div>
                                        <input type="text" 
                                               class="form-control" 
                                               name="options[]" 
                                               value="{{ $option->option_text }}"
                                               required>
                                        <button type="button" class="btn btn-danger remove-option">
                                            <i class="bx bx-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_points{{ $question->id }}" class="form-label">Points</label>
                        <input type="number"
                               class="form-control"
                               id="edit_points{{ $question->id }}"
                               name="points"
                               value="{{ $question->points }}"
                               min="1"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
    $(document).ready(function() {
        // Plus de JS pour ajout/suppression d'options : on a toujours 3 options fixes
        // Réinitialisation du modal d'ajout
        $('#addQuestionModal').on('hidden.bs.modal', function() {
            $('#question_text').val('');
            $('#points').val('1');
            // Réinitialise les champs d'option
            $('#options_container input[type="text"]').val("");
            $('#options_container input[type="radio"]').prop('checked', false);
        });
    });
</script>
@endpush

@endsection