<?php

namespace App\Http\Controllers;

use App\Enums\AnimalType;
use App\Models\Animal;
use App\Models\SolicitudAdopcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public function index()
    {
        $animales = Animal::latest()->paginate(10);
        return view('animales.index', compact('animales'));
    }

    public function create()
    {
        $tipos = AnimalType::labels();
        return view('animales.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'nombre' => 'required|string|min:2|max:100',
            'tipo'   => 'required|in:' . implode(',', AnimalType::values()),
            'edad'   => 'required|integer|min:0|max:30',
            'estado' => 'required|in:disponible,adoptado',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $datosValidados['foto'] = $request->file('foto')->store('animales', 'public');
        } else {
            unset($datosValidados['foto']);
        }

        try {
            Animal::create($datosValidados);
            return redirect()->route('animales.index')->with('success', 'Animal creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear animal', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'No se pudo crear el animal.');
        }
    }

    public function show(Animal $animal)
    {
        $solicitudAprobada = null;
        if (auth()->check() && auth()->user()->isAdmin()) {
            $solicitudAprobada = SolicitudAdopcion::with('adoptante')
                ->where('animal_id', $animal->id)
                ->where('estado', 'aprobada')
                ->first();
        }
        return view('animales.show', compact('animal', 'solicitudAprobada'));
    }

    public function edit(Animal $animal)
    {
        $tipos = AnimalType::labels();
        return view('animales.edit', compact('animal', 'tipos'));
    }

    public function update(Request $request, Animal $animal)
    {
        $datosValidados = $request->validate([
            'nombre' => 'required|string|min:2|max:100',
            'tipo'   => 'required|in:' . implode(',', AnimalType::values()),
            'edad'   => 'required|integer|min:0|max:30',
            'estado' => 'required|in:disponible,adoptado',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($animal->foto && Storage::disk('public')->exists($animal->foto)) {
                Storage::disk('public')->delete($animal->foto);
            }
            $datosValidados['foto'] = $request->file('foto')->store('animales', 'public');
        } else {
            unset($datosValidados['foto']);
        }

        try {
            $animal->update($datosValidados);
            return redirect()->route('animales.index')->with('success', 'Animal actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar animal', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'No se pudo actualizar el animal.');
        }
    }

    public function destroy(Animal $animal)
    {
        try {
            if ($animal->foto && Storage::disk('public')->exists($animal->foto)) {
                Storage::disk('public')->delete($animal->foto);
            }
            $animal->delete();
            return redirect()->route('animales.index')->with('success', 'Animal eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar animal', ['error' => $e->getMessage()]);
            return redirect()->route('animales.index')->with('error', 'No se pudo eliminar el animal.');
        }
    }
}
