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
            // Vérification si l'email existe déjà dans la base de données
            $existingUser = User::where('email', $student['email'])->first();

            if (!$existingUser) {
                // Si l'utilisateur n'existe pas, création
                User::create([
                    'name' => $student['name'],
                    'email' => $student['email'],
                    'password' => bcrypt('default_password'), // Assurez-vous de chiffrer le mot de passe
                    'role' => 'student', // Ou récupérer le rôle depuis le JSON
                    'promotion_id' => $student['promotion_id'], // Assurez-vous de récupérer la promotion de manière appropriée
                ]);
            } else {
                // Si l'utilisateur existe déjà, on passe à l'élément suivant
                continue;
            }
        }
        return redirect()->back()->with('success', 'Étudiants importés avec succès !');
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur introuvable.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}
