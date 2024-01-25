<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginateController extends Controller
{
    public function paginate_exam($limit, $offset, $user_id)
    {
        $data = DB::table('exam_patients')
        ->where('user_id', $user_id)
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json($data);
    }

    public function paginate_study($limit, $offset, $user_id)
    {
        $data = DB::table('study_patients')
        ->where('user_id', $user_id)
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json($data);
    }

}
