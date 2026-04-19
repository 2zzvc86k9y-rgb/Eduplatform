<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $quizzes = Quiz::where('course_id', $courseId)->get();
        return view('instructor.quiz.index', compact('course', 'quizzes'));
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('instructor.quiz.create', compact('course'));
    }

    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'nullable|integer|min:1',
            'passing_score' => 'required|integer|min:1|max:100',
        ]);

        $quiz = Quiz::create([
            'course_id' => $courseId,
            'instructor_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'time_limit' => $request->time_limit,
            'passing_score' => $request->passing_score,
            'is_published' => $request->has('is_published'),
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Quiz créé avec succès. Ajoutez maintenant des questions.',
            'alert-type' => 'success'
        ];

        return redirect()->route('instructor.quiz.questions.create', $quiz->id)->with($notification);
    }

    public function edit($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        return view('instructor.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, $quizId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'nullable|integer|min:1',
            'passing_score' => 'required|integer|min:1|max:100',
        ]);

        $quiz = Quiz::findOrFail($quizId);
        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'time_limit' => $request->time_limit,
            'passing_score' => $request->passing_score,
            'is_published' => $request->has('is_published'),
        ]);

        $notification = [
            'message' => 'Quiz mis à jour avec succès.',
            'alert-type' => 'success'
        ];

        return redirect()->route('instructor.quiz.index', $quiz->course_id)->with($notification);
    }

    public function destroy($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $courseId = $quiz->course_id;
        $quiz->delete();

        $notification = [
            'message' => 'Quiz supprimé avec succès.',
            'alert-type' => 'success'
        ];

        return redirect()->route('instructor.quiz.index', $courseId)->with($notification);
    }

    public function createQuestion($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        return view('instructor.quiz.questions.create', compact('quiz'));
    }

    public function storeQuestion(Request $request, $quizId)
    {
        $request->validate([
            'question' => 'required|string',
            'type' => 'required|in:multiple_choice,true_false',
            'points' => 'required|integer|min:1',
            'explanation' => 'nullable|string',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string',
            'options.*.is_correct' => 'required|boolean',
        ]);

        $question = QuizQuestion::create([
            'quiz_id' => $quizId,
            'question' => $request->question,
            'type' => $request->type,
            'points' => $request->points,
            'explanation' => $request->explanation,
        ]);

        foreach ($request->options as $option) {
            QuizOption::create([
                'question_id' => $question->id,
                'option_text' => $option['text'],
                'is_correct' => $option['is_correct'],
            ]);
        }

        $notification = [
            'message' => 'Question ajoutée avec succès.',
            'alert-type' => 'success'
        ];

        return redirect()->route('instructor.quiz.show', $quizId)->with($notification);
    }

    public function show($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        return view('instructor.quiz.show', compact('quiz'));
    }
} 