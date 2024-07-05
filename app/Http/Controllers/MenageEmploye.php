<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class MenageEmploye extends Controller
{
    public function all()
    {
        try {
            // Mengambil semua data dari model Employer
            $employers = Employee::all();

            // Mengembalikan data dalam bentuk respons JSON
            return response()->json([
                'status' => 'success',
                'data' => $employers
            ], 200);
        } catch (\Throwable $th) {
            // Mengembalikan respons jika terjadi error
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
