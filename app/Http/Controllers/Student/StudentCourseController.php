<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseLecture;

class StudentCourseController extends Controller
{
    public function markLectureComplete(Request $request)
    {
        $user = Auth::user();
        $lectureId = $request->lecture_id;

        // Enregistre la complétion (table completed_lectures)
        $user->completedLectures()->syncWithoutDetaching([$lectureId]);

        // Trouver la prochaine leçon (exemple simple)
        $currentLecture = CourseLecture::find($lectureId);
        $nextLecture = CourseLecture::where('section_id', $currentLecture->section_id)
            ->where('id', '>', $currentLecture->id)
            ->orderBy('id', 'asc')
            ->first();

        return response()->json([
            'success' => true,
            'next_url' => $nextLecture ? route('lecture.show', $nextLecture->id) : null
        ]);
    }
} 