<?php

namespace App\Http\Controllers;

use App\Models\AppMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Application;
use App\Models\AppModul;
use Illuminate\Support\Facades\Auth; // tambahkan ini
use App\Models\ActivityLog; // tambahkan ini

class DaftarMenuController extends Controller
{
    public function index(Request $request)
    {
        $query = AppMenu::query();

        if ($request->has('menu_name') && $request->menu_name != '') {
            $query->where('menu_name', 'like', '%' . $request->menu_name . '%');
        }

        if ($request->has('modul_name') && $request->module_name != '') {
            $query->whereHas('module', function($q) use ($request) {
                $q->where('modul_name', 'like', '%' . $request->modul_name . '%');
            });
        }

        if ($request->has('application_name') && $request->application_name != '') {
            $query->whereHas('application', function($q) use ($request) {
                $q->where('app_name', 'like', '%' . $request->application_name . '%');
            });
        }

        if ($request->has('menu_status') && $request->menu_status != '') {
            $query->where('menu_status', $request->menu_status);
        }

        if ($request->has('created_at') && $request->created_at != '') {
            try {
                $date = Carbon::createFromFormat('Y-m', $request->created_at);
                $query->whereYear('created_at', $date->year)
                      ->whereMonth('created_at', $date->month);
            } catch (\Exception $e) {
                // Handle the exception if the date format is incorrect
            }
        }

        $itemsPerPage = $request->get('items_per_page', 10);
        $menus = $query->paginate($itemsPerPage);

        return view('Master.DaftarMenu.DaftarMenu', compact('menus'));
    }

    public function create()
    {
        $applications = Application::all();
        $modules = AppModul::all();
        return view('Master.DaftarMenu.Create', compact('applications', 'modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_description' => 'required|string',
            'menu_status' => 'required|string',
            'application_id' => 'required|exists:applications,id',
            'modul_id' => 'required|exists:app_moduls,id',
        ], [
            'menu_name.required' => 'Nama menu wajib diisi.',
            'menu_name.string' => 'Nama menu harus berupa teks.',
            'menu_name.max' => 'Nama menu tidak boleh lebih dari 255 karakter.',
            'menu_description.required' => 'Deskripsi menu wajib diisi.',
            'menu_status.required' => 'Status menu wajib diisi.',
            'application_id.required' => 'Aplikasi wajib dipilih.',
            'application_id.exists' => 'Aplikasi yang dipilih tidak valid.',
            'modul_id.required' => 'Modul wajib dipilih.',
            'modul_id.exists' => 'Modul yang dipilih tidak valid.',
        ]);

        $menu = AppMenu::create($request->only([
            'menu_name',
            'menu_description',
            'menu_status',
            'application_id',
            'modul_id',
        ]));

        // Activity log untuk create menu
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            ActivityLog::create([
                'description' => $user->username . ' menambahkan menu ' . $menu->menu_name,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('menus.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $menus = AppMenu::findOrFail($id);
        $applications = Application::all();
        $modules = AppModul::where('application_id', $menus->application_id)->get();
        return view('Master.DaftarMenu.Edit', compact('menus', 'applications', 'modules'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_description' => 'required|string',
            'menu_status' => 'required|string',
            'application_id' => 'required|exists:applications,id',
            'modul_id' => 'required|exists:app_moduls,id',
        ], [
            'menu_name.required' => 'Nama menu wajib diisi.',
            'menu_description.required' => 'Deskripsi menu wajib diisi.',
            'menu_status.required' => 'Status menu wajib diisi.',
            'application_id.required' => 'Aplikasi wajib dipilih.',
            'application_id.exists' => 'Aplikasi yang dipilih tidak valid.',
            'modul_id.required' => 'Modul wajib dipilih.',
            'modul_id.exists' => 'Modul yang dipilih tidak valid.',
        ]);

        $menus = AppMenu::findOrFail($id);
        $oldName = $menus->menu_name;
        $oldDescription = $menus->menu_description;
        $oldStatus = $menus->menu_status;
        $oldAppId = $menus->application_id;
        $oldModulId = $menus->modul_id;

        $menus->update($request->only([
            'menu_name',
            'menu_description',
            'menu_status',
            'application_id',
            'modul_id',
        ]));

        // Activity log untuk update menu
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            // Log perubahan nama menu
            if ($oldName !== $menus->menu_name) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah nama menu ' . $oldName . ' menjadi ' . $menus->menu_name,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan deskripsi menu
            if ($oldDescription !== $menus->menu_description) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah deskripsi di menu ' . $menus->menu_name,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan status menu
            if ($oldStatus !== $menus->menu_status) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah status di menu ' . $menus->menu_name,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan aplikasi menu
            if ($oldAppId != $menus->application_id) {
                $oldApp = Application::find($oldAppId);
                $newApp = Application::find($menus->application_id);
                ActivityLog::create([
                    'description' => $user->username . ' memindahkan menu ' . $menus->menu_name . ' dari aplikasi ' . ($oldApp ? $oldApp->app_name : '-') . ' ke ' . ($newApp ? $newApp->app_name : '-'),
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan modul menu
            if ($oldModulId != $menus->modul_id) {
                $oldModul = AppModul::find($oldModulId);
                $newModul = AppModul::find($menus->modul_id);
                ActivityLog::create([
                    'description' => $user->username . ' memindahkan menu ' . $menus->menu_name . ' dari modul ' . ($oldModul ? $oldModul->modul_name : '-') . ' ke ' . ($newModul ? $newModul->modul_name : '-'),
                    'user_id' => $user->id,
                ]);
            }
        }

        return redirect()->route('menus.index')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $menus = AppMenu::findOrFail($id);
        $menuName = $menus->menu_name;
        $menus->delete();

        // Activity log untuk hapus menu
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            ActivityLog::create([
                'description' => $user->username . ' menghapus menu ' . $menuName,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('menus.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function getModules($applicationId)
    {
        $modules = AppModul::where('application_id', $applicationId)->get();
        return response()->json($modules);
    }
}
