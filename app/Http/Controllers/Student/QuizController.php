<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        // Récupérer tous les cours auxquels l'utilisateur est inscrit
        $courseIds = \App\Models\Order::where('user_id', $userId)
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->where('payments.status', 'confirm')
            ->pluck('course_id');
        $courses = \App\Models\Course::whereIn('id', $courseIds)
            ->with(['quizzes' => function($q) use ($userId) {
                $q->with(['questions', 'userAttempts' => function($q2) use ($userId) {
                    $q2->where('user_id', $userId);
                }]);
            }])
            ->get();
        return view('student.quiz.index', compact('courses'));
    }

    public function show($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        $latestAttempt = $quiz->latestAttempt();
        
        return view('student.quiz.show', compact('quiz', 'latestAttempt'));
    }

    public function start($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        
        // Vérifier si l'utilisateur a déjà une tentative en cours
        $inProgressAttempt = QuizAttempt::where('quiz_id', $quizId)
            ->where('user_id', Auth::id())
            ->whereNull('completed_at')
            ->first();

        if ($inProgressAttempt) {
            return redirect()->route('student.quiz.take', [$quiz->course_id, $quizId]);
        }

        // Créer une nouvelle tentative
        QuizAttempt::create([
            'quiz_id' => $quizId,
            'user_id' => Auth::id(),
            'answers' => [],
            'score' => 0,
            'passed' => false,
            'started_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Quiz commencé. Bonne chance !',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.quiz.take', [$quiz->course_id, $quizId])->with($notification);
    }

    public function take($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        $attempt = QuizAttempt::where('quiz_id', $quizId)
            ->where('user_id', Auth::id())
            ->whereNull('completed_at')
            ->firstOrFail();

        $timeRemaining = null;
        if ($quiz->time_limit) {
            $timeRemaining = $quiz->time_limit * 60 - Carbon::now()->diffInSeconds($attempt->started_at);
            if ($timeRemaining <= 0) {
                return $this->submit(new Request(), $quizId);
            }
        }

        return view('student.quiz.take', compact('quiz', 'attempt', 'timeRemaining'));
    }

    public function submit(Request $request, $quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        $attempt = QuizAttempt::where('quiz_id', $quizId)
            ->where('user_id', Auth::id())
            ->whereNull('completed_at')
            ->firstOrFail();

        $answers = $request->answers ?? [];
        $score = 0;
        $totalPoints = 0;

        foreach ($quiz->questions as $question) {
            $totalPoints += $question->points;
            $userAnswer = $answers[$question->id] ?? null;
            
            if ($userAnswer) {
                $correctOption = $question->correctOption();
                if ($correctOption && $correctOption->id == $userAnswer) {
                    $score += $question->points;
                }
            }
        }

        $finalScore = $totalPoints > 0 ? round(($score / $totalPoints) * 100) : 0;
        $passed = $finalScore >= $quiz->passing_score;

        $attempt->update([
            'answers' => $answers,
            'score' => $finalScore,
            'passed' => $passed,
            'completed_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Quiz terminé avec succès !',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.quiz.result', [$quiz->course_id, $quizId])->with($notification);
    }

    public function result($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        $attempt = QuizAttempt::where('quiz_id', $quizId)
            ->where('user_id', Auth::id())
            ->whereNotNull('completed_at')
            ->latest()
            ->firstOrFail();

        return view('student.quiz.result', compact('quiz', 'attempt'));
    }
} 