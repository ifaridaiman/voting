<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class IngestController extends Controller
{
     // Page ingesting user
     public function register(){
        return view('ingest.register');
    }

    // Ingesting csv file function
    public function ingest(Request $request){

        $validator = Validator::make($request->all(),[
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // Read the CSV file and insert into the database
        $file = $request->file('csv_file');
        $rows =  array_map('str_getcsv', file($file));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            $name = User::create([
                'name' => $data['Name'],
                'email' => $data['Email'],
                'category' => $data['Category']

            ]);


        }

        return redirect()
            ->back()
            ->with('success', 'CSV file imported successfully.');

    }
}
