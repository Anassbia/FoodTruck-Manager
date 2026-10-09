<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidationController extends Controller
{
    public function checkUniqueness(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');
        $id = $request->input('id'); // Optional for update operations

        $fieldMap = [
            'email'     => ['table' => 'employees', 'column' => 'email', 'idColumn' => 'id_employee'],
            'username'  => ['table' => 'admins', 'column' => 'username', 'idColumn' => 'id_admin'],
            'cin'       => ['table' => 'employees', 'column' => 'cin', 'idColumn' => 'id_employee'],
            'matricule' => ['table' => 'employees', 'column' => 'matricule', 'idColumn' => 'id_employee'],
        ];

        if (!isset($fieldMap[$field])) {
            return response()->json(['valid' => true]);
        }

        $query = DB::table($fieldMap[$field]['table'])->where($fieldMap[$field]['column'], $value);

        if ($id) {
            $query->where($fieldMap[$field]['idColumn'], '!=', $id);
        }

        $exists = $query->exists();

        return response()->json([
            'valid' => !$exists
        ]);
    }
}

