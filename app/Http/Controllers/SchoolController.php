<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\School;
use App\Models\SchoolAddress;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    public function index()
    {
        return Inertia::render('Schools/Index');
    }

    public function create()
    {
        return Inertia::render('Schools/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Validação dos campos da escola
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:schools,cnpj',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:schools,email',
            'director' => 'required|string|max:255',
            'year_of_foundation' => 'required|integer|min:1900|max:' . date('Y'),
            // Validação dos campos do endereço
            'zip_code' => 'required|string|max:10',
            'street' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Criar a escola
            $school = School::create([
                'name' => $validated['name'],
                'cnpj' => $validated['cnpj'],
                'telephone' => $validated['telephone'],
                'email' => $validated['email'],
                'director' => $validated['director'],
                'year_of_foundation' => $validated['year_of_foundation'],
            ]);

            // Criar o endereço associado à escola
            SchoolAddress::create([
                'school_id' => $school->id,
                'zip_code' => $validated['zip_code'],
                'street' => $validated['street'],
                'neighborhood' => $validated['neighborhood'],
                'city' => $validated['city'],
                'number' => $validated['number'],
                'complement' => $validated['complement'] ?? null,
            ]);

            DB::commit();

            return redirect()->route('schools.index')
                ->with('success', 'Escola criada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao criar escola: ' . $e->getMessage()]);
        }
    }
}

