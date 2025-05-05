<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Exports\SiswaExport;
use App\Exports\SiswaPDFExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'kelas', 'jurusan', 'jenis_kelamin']);
        $sort = $request->get('sort', 'nama');
        $direction = $request->get('direction', 'asc');
        
        if ($request->has('export')) {
            if ($request->export === 'excel') {
                return Excel::download(new SiswaExport($filters), 'daftar_siswa.xlsx');
            } elseif ($request->export === 'pdf') {
                return (new SiswaPDFExport($filters))->download();
            }
        }
        
        $siswa = Siswa::search($filters)
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        // Statistics
        $totalSiswa = Siswa::count();
        $totalKelas = Siswa::distinct('kelas')->count('kelas');
        $totalJurusan = Siswa::distinct('jurusan')->count('jurusan');
        $totalLaki = Siswa::where('jenis_kelamin', 'laki-laki')->count();
        $totalPerempuan = Siswa::where('jenis_kelamin', 'perempuan')->count();

        return view('siswa.index', compact(
            'siswa', 'sort', 'direction', 'filters',
            'totalSiswa', 'totalKelas', 'totalJurusan',
            'totalLaki', 'totalPerempuan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view to create a new student
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nis' => 'required|numeric|unique:siswas,nis',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|in:10,11,12',
            'jurusan' => 'required|in:br,dkv1,dkv2,rpl,mp,ak',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|string|max:255',
        ]);

        // Create a new student record
        Siswa::create($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('siswa.index')->with('success', 'Siswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the student by ID
        $siswa = Siswa::findOrFail($id);
        // Return the view with the student details
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the student by ID
        $siswa = Siswa::findOrFail($id);
        // Return the view to edit the student
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Fetch the student by ID
        $siswa = Siswa::findOrFail($id);
        // Validate the request data
        $request->validate([
            'nis' => 'required|numeric|unique:siswas,nis,' . $siswa->id,
            'nama' => 'required|string|max:255',
            'kelas' => 'required|in:10,11,12',
            'jurusan' => 'required|in:br,dkv1,dkv2,rpl,mp,ak',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|string|max:255',
        ]);
        // Update the student record
        $siswa->update($request->all());
        // Redirect to the index page with a success message
        return redirect()->route('siswa.index')->with('success', 'Siswa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the student by ID
        $siswa = Siswa::findOrFail($id);
        // Delete the student record
        $siswa->delete();
        // Redirect to the index page with a success message
        return redirect()->route('siswa.index')->with('success', 'Siswa deleted successfully.');
    }
}
