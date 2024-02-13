<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\ExcelImpoter;
use Maatwebsite\Excel\Facades\Excel;



class ExcelImportController extends Controller
{

    public function index() {
        return view('admin.employee.create');
 
    }
    
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
 
        // Get the uploaded file
        $file = $request->file('file');
 
        // Process the Excel file
        Excel::import(new ExcelImpoter, $file);
 
        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }

}
