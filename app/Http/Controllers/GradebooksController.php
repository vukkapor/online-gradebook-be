<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gradebook;
use App\Student;
use App\Comment;

class GradebooksController extends Controller
{
    public function index()
    {
        $currentPage = request()->input('current_page');
        $numberShown = request()->input('numberShown');
        if ($currentPage) {
            $gradebooks = Gradebook::with('professor')->orderBy('gradebooks.id', 'desc')->paginate($currentPage * $numberShown);
        } else {
            $gradebooks = Gradebook::with('professor')->get();
        }

        return $gradebooks;
    }

    public function store(Request $request)
    {
        $gradebook = new Gradebook();

        $gradebook->name = $request->input('name');
        $gradebook->professor_id = $request->input('professor_id');

        $gradebook->save();

        return $gradebook;
    }

    public function show($id)
    {
        $gradebook = Gradebook::with('professor', 'comments', 'students')->findOrFail($id);
        return $gradebook;
    }

    public function update(Request $request, $id)
    {
        $gradebook = Gradebook::findOrFail($id);

        $gradebook = Gradebook::with('students')->find($id);
        $gradebook->name = $request->input('name');
        if ($gradebook->professor->id !== $request->input('professor_id')) {
            $gradebook->professor_id = $request->input('professor_id');
        }
        $newStudents = $request->input('students');

        foreach ($gradebook->students as $oldStudent) {
            $found = false;
            foreach ($newStudents as $newStudentKey => $newStudent) {
                if (!array_key_exists('id', $newStudent)) {
                    $tempName = $newStudent['name'];
                    unset($newStudents[$newStudentKey]);
                    $newStudent = new Student();
                    $newStudent->name = $tempName;
                    $newStudent->image_link = 'randomlink.jpg';
                    $newStudent->gradebook_id = $id;

                    $newStudent->save();
                } else if ($oldStudent->id === $newStudent['id']) {
                    $found = true;
                }
            }
            if (!$found) {
                $oldStudent->delete();
            }
        }
        $gradebook->save();
        return $gradebook;
    }

    public function addComment(Request $request, $id)
    {
        $comment = new Comment();

        $comment->text = $request->input('text');
        $comment->user_id = $request->input('user_id');
        $comment->gradebook_id = $id;

        $comment->save();

        return $comment;
    }

    public function addStudent(Request $request, $id)
    {
        $student = new Student();

        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('first_name');
        $student->img = $request->input('img');
        $student->gradebook_id = $id;

        $student->save();

        return $student;
    }

    public function destroy($id)
    {
        $gradebook = Gradebook::findOrFail($id);
        $gradebook->delete();
        return $gradebook;
    }
}
