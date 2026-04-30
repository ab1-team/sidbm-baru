<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Anggota::query();

        // Search by name or NIK
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by Desa
        if ($request->desa) {
            $query->where('desa', $request->desa);
        }

        $anggota = $query->orderBy('nama_lengkap', 'asc')->paginate($request->per_page ?? 10);

        return response()->json($anggota);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|size:16|unique:anggota,nik',
            'nama_lengkap' => 'required|string|max:225',
            'jenis_kelamin' => 'required|in:L,P',
            'desa' => 'required|string',
            'hp' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $anggota = Anggota::create($request->all());

        return response()->json([
            'message' => 'Anggota created successfully',
            'data' => $anggota
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        return response()->json($anggota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|size:16|unique:anggota,nik,' . $anggota->id,
            'nama_lengkap' => 'required|string|max:225',
            'jenis_kelamin' => 'required|in:L,P',
            'desa' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $anggota->update($request->all());

        return response()->json([
            'message' => 'Anggota updated successfully',
            'data' => $anggota
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return response()->json([
            'message' => 'Anggota deleted successfully'
        ]);
    }
}
