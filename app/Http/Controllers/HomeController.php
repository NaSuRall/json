<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index(){
        $datas = User::all();
        return view('dashboard', compact('datas'));
    }

    public function importStudents(Request $request){

        $request->validate([
            'jsonFile' => 'required|file|mimes:json'
        ]);

        $jsonContent = file_get_contents($request->file('jsonFile')->getPathname());
        $data = json_decode($jsonContent, true);

        if (!$data) {
            return redirect()->back()->withErrors(['jsonFile' => 'Json file is not valid']);
        }

        foreach ($data as $student) {
          User::create([
              'name' => $student['name'],
              'email' => $student['email'],
              'password' => Hash::make($student['password']),
          ]);

        }
        return redirect()->back()->with('success', 'Étudiants importés avec succès !');
    }
}
