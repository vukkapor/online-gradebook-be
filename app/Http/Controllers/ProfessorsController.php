<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\ProfessorImages;
use App\Gradebook;

class ProfessorsController extends Controller
{
    public function index()
    {
        $professors = Professor::with('gradebook')->get();

        return $professors;
    }

    public function store(Request $request)
    {
        $professor = new Professor();
        $professor->first_name = $request->input('first_name');
        $professor->last_name = $request->input('last_name');
        $professor->user_id = $request->input('user_id');
        $professor->img = $request['img'][0];
        $professor->save();
        $img = $request['img'];
        $gradebook = Gradebook::find($request->input('gradebook_id'));
        $gradebook->professor_id = $professor->id;
        foreach ($img as $i) {
            $professorImage = new ProfessorImages();
            $professorImage->professor_id = $professor->id;
            $professorImage->imageURL = $i;
            $professorImage->save();
        }
        return $professor;


        $professor->save();

        return $professor;
    }

    public function showByUser($id)
    {
        $professor = Professor::with('gradebook')->findOrFail($id);
        if ($professor->gradebook) {
            $professor->gradebook->students;
            $professor->gradebook->comments;
        }
        return $professor;
    }
}
