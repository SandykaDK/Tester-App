<?php

namespace App\Http\Controllers;

use App\Models\AppMenu;
use Illuminate\Support\Str;
use App\Models\ScreenFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScreenFormatController extends Controller
{
    public function index(Request $request)
    {
        $query = ScreenFormat::query();

        if ($request->file_name) {
            $query->where('scr_name', 'like', '%' . $request->file_name . '%');
        }

        $perPage = (int) $request->input('items_per_page', 10);
        $files = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return view('ScreenFormat.ScreenFormat', compact('files'));
    }

    public function create()
    {
        return view('ScreenFormat.Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'scr_file'        => 'required|file|mimes:xlsx|max:5000',
            'menu_id'         => 'required|exists:app_menus,id',
            'scr_version'     => 'required|string|max:255',
            'scr_description' => 'nullable|string|max:255',
        ]);

        $menu = AppMenu::find($request->menu_id);

        $file = $request->file('scr_file');
        $filename = $file->getClientOriginalName();

        // dd($file);
        // dd($filename);

        Storage::disk('public')->putFileAs('screenformat', $file, $filename);

        dd('sukses');

        ScreenFormat::create([
            'id_scr_format'   => (string) Str::uuid(),
            'scr_name'        => $filename,
            'menu_id'         => $menu->id,
            'scr_version'     => $request->scr_version,
            'scr_description' => $request->scr_description,
        ]);

        return redirect()->route('screen-format.index')->with('success', 'Screen format berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $screenFormat = ScreenFormat::findOrFail($id);
        return view('ScreenFormat.Edit', compact('screenFormat'));
    }

    public function update(Request $request, $id)
    {
        $screenFormat = ScreenFormat::findOrFail($id);

        $request->validate([
            'scr_file'        => 'nullable|file',
            'menu_id'         => 'required|exists:app_menus,id',
            'scr_version'     => 'required|string|max:255',
            'scr_description' => 'nullable|string|max:255',
        ]);

        $menu = AppMenu::find($request->menu_id);

        $data = [
            'menu_id'         => $menu->id,
            'scr_version'     => $request->scr_version,
            'scr_description' => $request->scr_description,
        ];

        if ($request->hasFile('scr_file')) {
            $file = $request->file('scr_file');
            $filename = $file->getClientOriginalName();

            try {
                $path = Storage::disk('public')->putFileAs('screenformats', $file, $filename);
            } catch (\Exception $e) {
                return back()->withErrors(['scr_file' => 'File gagal diupload: ' . $e->getMessage()]);
            }
            $data['scr_name'] = $filename;
        }

        $screenFormat->update($data);

        return redirect()->route('screen-format.index')->with('success', 'Screen format berhasil diupdate.');
    }

    // Endpoint untuk autocomplete menu
    public function searchMenus(Request $request)
    {
        $term = $request->input('q');
        $menus = AppMenu::where('menu_name', 'like', '%' . $term . '%')
            ->select('id', 'menu_name')
            ->limit(10)
            ->get();
        return response()->json($menus);
    }
}
