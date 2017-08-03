<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function developer()
    {
        return view('developer.index');
    }

    public function testing()
    {
        return view('developer.test');
    }

    public function all_notes($student_id)
    {
        $data = ["id" => $student_id,
            "name" => "Tomas",
            "last_name" => "Ixen",
            "notes" => [
                "matematica" => 87,
                "musica" => 99,
                "lenguaje" => 76,
            ]];

        return json_encode($data);
    }

    public function specific_note($student_id, $matter_id)
    {
        $data = ["student_id" => $student_id,
            "name" => "Tomas",
            "last_name" => "Ixen",
            "matter_id" => "$matter_id",
            "notes" => [
                "primer examen" => 10,
                "segundo examen" => 20,
                "actividades" => 4,
                "examen_final" => 35,
            ]];

        return json_encode($data);
    }

    public function only_notes($student_id, $matter_id)
    {
        $data = [
            "id" => (int)$student_id,
            "name" => "Tomas",
            "last_name" => "Ixen",
            "matter_id" => (int)$matter_id,
            "primer examen" => 10,
            "segundo examen" => 20,
            "actividades" => 4,
            "examen_final" => 35,
        ];

        return json_encode($data);
    }
}
