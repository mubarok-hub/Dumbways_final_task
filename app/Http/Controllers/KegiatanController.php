<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Tag;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::where('user_id', auth()->id());

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        $kegiatan = $query->with('tags')->paginate(2)->withQueryString();

        return view('kegiatan.index', compact('kegiatan'));
    }
    public function create()
    {
        $tags = Tag::all();
        return view('kegiatan.create', compact('tags'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        //simpan gambar kalau ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $validated['gambar'] = $filename;
        }

        $validated['user_id'] = auth()->id();


        $kegiatan = Kegiatan::create($validated);

        // Jika ada tag yang dipilih, simpan relasi
        if ($request->has('tags')) {
            $kegiatan->tags()->attach($request->input('tags'));
        }
        return redirect()->route('kegiatan.index')->with('success', 'Berhasil menambah kegiatan. ');
    
    }

    public function edit(Kegiatan $kegiatan)
    {
        $this->authorize('update', $kegiatan);
        $tags = Tag::all();

        return view('kegiatan.edit', compact('kegiatan', 'tags'));
    }
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $this->authorize('update', $kegiatan);

        $validated = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        
         if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && file_exists(public_path('uploads/' . $kegiatan->gambar))) {
                unlink(public_path('uploads/' . $kegiatan->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $validated['gambar'] = $filename;
        }

        $kegiatan->update($validated);

        // Update tags if provided (ganti semuda dengan yang baru)
        if ($request->has('tags')) {
            $kegiatan->tags()->sync($request->input('tags'));
        } else { //kalo gada yang di centang, kosongkan
            $kegiatan->tags()->sync([]);
        }
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil di perbarui');        
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $this->authorize('delete', $kegiatan);

        if ($kegiatan->gambar) {
            Storage::disk('public')->delete('uploads/' . $kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('tags'); // Load tags relationship
        return view('kegiatan.show', compact('kegiatan'));
    }

}
