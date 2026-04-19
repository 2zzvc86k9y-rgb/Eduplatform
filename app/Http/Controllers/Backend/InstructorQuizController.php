<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorQuizController extends Controller
{
    public function index(Course $course)
    {
        $quizzes = $course->quizzes()->with('questions')->get();
        return view('instructor.courses.quiz.index', compact('course', 'quizzes'));
    }

    public function create(Course $course)
    {
        return view('instructor.courses.quiz.form', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempts' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        $quiz = $course->quizzes()->create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'passing_score' => $request->passing_score,
            'max_attempts' => $request->max_attempts,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('course.quizzes', $course->id)
            ->with('success', 'Quiz créé avec succès');
    }

    public function edit(Course $course, Quiz $quiz)
    {
        return view('instructor.courses.quiz.form', compact('course', 'quiz'));
    }

    public function update(Request $request, Course $course, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempts' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'passing_score' => $request->passing_score,
            'max_attempts' => $request->max_attempts,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('course.quizzes', $course->id)
            ->with('success', 'Quiz mis à jour avec succès');
    }

    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('course.quizzes', $course->id)
            ->with('success', 'Quiz supprimé avec succès');
    }

    public function manageQuestions(Course $course, Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->get();
        return view('instructor.courses.quiz.questions', compact('course', 'quiz', 'questions'));
    }

    public function storeQuestion(Request $request, Course $course, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false,short_answer',
            'points' => 'required|integer|min:1',
            'options' => 'required_if:question_type,multiple_choice|array',
            'options.*' => 'required_if:question_type,multiple_choice|string',
            'correct_answer' => 'required',
        ]);

        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'points' => $request->points,
        ]);

        if ($request->question_type === 'multiple_choice') {
            foreach ($request->options as $index => $optionText) {
                $question->options()->create([
                    'option_text' => $optionText,
                    'is_correct' => $index == $request->correct_answer,
                ]);
            }
        } elseif ($request->question_type === 'true_false') {
            $question->options()->createMany([
                [
                    'option_text' => 'Vrai',
                    'is_correct' => $request->correct_answer === 'true',
                ],
                [
                    'option_text' => 'Faux',
                    'is_correct' => $request->correct_answer === 'false',
                ],
            ]);
        } else {
            $question->options()->create([
                'option_text' => $request->correct_answer,
                'is_correct' => true,
            ]);
        }

        return redirect()->route('manage.quiz.questions', [$course->id, $quiz->id])
            ->with('success', 'Question ajoutée avec succès');
    }

    public function updateQuestion(Request $request, QuizQuestion $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false,short_answer',
            'points' => 'required|integer|min:1',
            'options' => 'required_if:question_type,multiple_choice|array',
            'options.*' => 'required_if:question_type,multiple_choice|string',
            'correct_answer' => 'required',
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'points' => $request->points,
        ]);

        // Supprimer les anciennes options
        $question->options()->delete();

        if ($request->question_type === 'multiple_choice') {
            foreach ($request->options as $index => $optionText) {
                $question->options()->create([
                    'option_text' => $optionText,
                    'is_correct' => $index == $request->correct_answer,
                ]);
            }
        } elseif ($request->question_type === 'true_false') {
            $question->options()->createMany([
                [
                    'option_text' => 'Vrai',
                    'is_correct' => $request->correct_answer === 'true',
                ],
                [
                    'option_text' => 'Faux',
                    'is_correct' => $request->correct_answer === 'false',
                ],
            ]);
        } else {
            $question->options()->create([
                'option_text' => $request->correct_answer,
                'is_correct' => true,
            ]);
        }

        return redirect()->route('manage.quiz.questions', [$question->quiz->course_id, $question->quiz_id])
            ->with('success', 'Question mise à jour avec succès');
    }

    public function deleteQuestion(QuizQuestion $question)
    {
        $courseId = $question->quiz->course_id;
        $quizId = $question->quiz_id;
        
        $question->delete();

        return redirect()->route('manage.quiz.questions', [$courseId, $quizId])
            ->with('success', 'Question supprimée avec succès');
    }
} 