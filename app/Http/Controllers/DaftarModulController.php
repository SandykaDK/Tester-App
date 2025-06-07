<?php

namespace App\Http\Controllers;

use App\Models\AppModul;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class DaftarModulController extends Controller
{
    public function index(Request $request)
    {
        $query = AppModul::query();

        if ($request->has('module_name') && $request->module_name != '') {
            $query->where('modul_name', 'like', '%' . $request->module_name . '%');
        }

        if ($request->has('application_name') && $request->application_name != '') {
            $query->whereHas('application', function($q) use ($request) {
                $q->where('app_name', 'like', '%' . $request->application_name . '%');
            });
        }

        if ($request->has('modul_status') && $request->modul_status != '') {
            $query->where('modul_status', $request->modul_status);
        }

        // Tambahkan kembali fitur pagination
        $itemsPerPage = (int) $request->get('items_per_page', 10);
        if (!in_array($itemsPerPage, [10, 25, 50, 100])) {
            $itemsPerPage = 10;
        }
        $modules = $query->paginate($itemsPerPage);

        return view('Master.DaftarModul.DaftarModul', compact('modules', 'itemsPerPage'));
    }

    public function create()
    {
        $applications = Application::all();
        return view('Master.DaftarModul.Create', compact('applications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modul_name' => 'required|string|max:255',
            'modul_description' => 'required|string',
            'modul_status' => 'required|string',
            'application_id' => 'required|exists:applications,id',
        ]);

        $modul = AppModul::create($request->only([
            'modul_name',
            'modul_description',
            'modul_status',
            'application_id',
        ]));

        // Activity log untuk create modul
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            ActivityLog::create([
                'description' => $user->username . ' menambahkan modul ' . $modul->modul_name,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('modules.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $module = AppModul::findOrFail($id);
        $applications = Application::all();
        return view('Master.DaftarModul.Edit', compact('module', 'applications'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'modul_name' => 'required|string|max:255',
            'modul_description' => 'required|string',
            'modul_status' => 'required|string',
            'application_id' => 'required|exists:applications,id',
        ]);

        $module = AppModul::findOrFail($id);
        $oldName = $module->modul_name;
        $oldDescription = $module->modul_description;
        $oldStatus = $module->modul_status;
        $oldAppId = $module->application_id;

        $module->update($request->only([
            'modul_name',
            'modul_description',
            'modul_status',
            'application_id',
        ]));

        // Activity log untuk update modul
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            // Log perubahan nama modul
            if ($oldName !== $module->modul_name) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah nama modul ' . $oldName . ' menjadi ' . $module->modul_name,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan deskripsi modul
            if ($oldDescription !== $module->modul_description) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah deskripsi di modul ' . $module->modul_name,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan status modul
            if ($oldStatus !== $module->modul_status) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah status di modul ' . $module->modul_name,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan aplikasi modul
            if ($oldAppId != $module->application_id) {
                $oldApp = Application::find($oldAppId);
                $newApp = Application::find($module->application_id);
                ActivityLog::create([
                    'description' => $user->username . ' memindahkan modul ' . $module->modul_name . ' dari aplikasi ' . ($oldApp ? $oldApp->app_name : '-') . ' ke ' . ($newApp ? $newApp->app_name : '-'),
                    'user_id' => $user->id,
                ]);
            }
        }

        return redirect()->route('modules.index')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $module = AppModul::findOrFail($id);
        $modulName = $module->modul_name;
        $module->delete();

        // Activity log untuk hapus modul
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            ActivityLog::create([
                'description' => $user->username . ' menghapus modul ' . $modulName,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('modules.index')->with('success', 'Data Berhasil Dihapus');
    }
}
