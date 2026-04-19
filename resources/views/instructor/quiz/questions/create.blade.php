@extends('instructor.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">Ajouter une question au quiz : {{ $quiz->title }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Nouvelle question</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('instructor.quiz.questions.store', $quiz->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type de question</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="multiple_choice">Choix multiple</option>
                                        <option value="true_false">Vrai/Faux</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="points">Points</label>
                                    <input type="number" class="form-control" id="points" name="points" min="1" value="1" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="explanation">Explication de la réponse correcte</label>
                            <textarea class="form-control" id="explanation" name="explanation" rows="2"></textarea>
                        </div>

                        <div id="options-container">
                            <label>Options de réponse</label>
                            <div class="add_item">

                                <!-- Option 1 -->
                                <div class="row dynamic-option">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" name="options[0][text]" class="form-control option-text" placeholder="Option 1" required>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input option-radio" type="radio" name="correct_option" value="0" required>
                                                <label class="form-check-label">Réponse correcte</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Option 2 -->
                                <div class="row dynamic-option">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" name="options[1][text]" class="form-control option-text" placeholder="Option 2" required>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input option-radio" type="radio" name="correct_option" value="1">
                                                <label class="form-check-label">Réponse correcte</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group mt-3">
                                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Ajouter une option</a>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Ajouter la question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template pour une option dynamique -->
<div style="display: none">
    <div class="option-template">
        <div class="row dynamic-option">
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" class="form-control option-text" placeholder="Option">
                    <div class="form-check mt-2">
                        <input class="form-check-input option-radio" type="radio" name="correct_option">
                        <label class="form-check-label">Réponse correcte</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm remove-option"><i class="fa fa-minus-circle"></i> Supprimer</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        let optionCount = 2;

        // Réindexe les options (input name et valeur du radio)
        function reindexOptions() {
            $('#options-container .dynamic-option').each(function(index){
                $(this).find('.option-text').attr('name', `options[${index}][text]`);
                $(this).find('.option-radio').val(index);
            });
        }

        // Ajout d'une nouvelle option
        $(document).on("click", ".addeventmore", function(){
            const newOption = $('.option-template .dynamic-option').clone();
            $('#options-container .add_item').append(newOption);
            optionCount++;
            reindexOptions();
        });

        // Suppression d'une option
        $(document).on("click", ".remove-option", function(){
            $(this).closest('.dynamic-option').remove();
            optionCount--;
            reindexOptions();
        });

        // Changement de type de question
        $('#type').on('change', function(){
            const isTrueFalse = $(this).val() === 'true_false';
            const options = $('#options-container .dynamic-option');

            if (isTrueFalse) {
                // Forcer 2 options : Vrai/Faux
                options.eq(0).find('.option-text').val('Vrai').prop('readonly', true);
                options.eq(1).find('.option-text').val('Faux').prop('readonly', true);

                // Supprimer toutes les autres
                options.slice(2).remove();
                optionCount = 2;
                $('.addeventmore').hide();
                reindexOptions();
            } else {
                options.eq(0).find('.option-text').val('').prop('readonly', false);
                options.eq(1).find('.option-text').val('').prop('readonly', false);
                $('.addeventmore').show();
                reindexOptions();
            }
        });

        // Initialisation
        reindexOptions();
    });
</script>
@endpush
@endsection
