<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Models\Application;
use Illuminate\Http\Request;

class DaftarAplikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::query();

        if ($request->has('app_name') && $request->app_name != '') {
            $query->where('app_name', 'like', '%' . $request->app_name . '%');
        }

        if ($request->has('app_status') && $request->app_status != '') {
            $query->where('app_status', $request->app_status);
        }

        $itemsPerPage = $request->get('items_per_page', 10);
        $applications = $query->paginate($itemsPerPage);

        return view('Master.DaftarAplikasi.DaftarAplikasi', compact('applications'));
    }

    public function create()
    {
        return view('Master.DaftarAplikasi.Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'required|string',
            'app_status' => 'required|string',
        ]);

        $application = Application::create($request->all());

        // Simpan activity log
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            \App\Models\ActivityLog::create([
                'description' => $user->username . ' menambahkan aplikasi ' . $application->app_name,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('applications.index')->with('success', 'Data Aplikasi berhasil disimpan.');
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);
        return view('Master.DaftarAplikasi.Edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'required|string',
            'app_status' => 'required|string',
        ]);

        $application = Application::findOrFail($id);
        $oldName = $application->app_name;
        $oldDescription = $application->app_description;
        $oldStatus = $application->app_status;

        $application->update($request->all());

        $newName = $application->app_name;
        $newDescription = $application->app_description;
        $newStatus = $application->app_status;

        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            // Log perubahan nama aplikasi
            if ($oldName !== $newName) {
                \App\Models\ActivityLog::create([
                    'description' => $user->username . ' mengubah nama di aplikasi ' . $oldName . ' menjadi ' . $newName,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan deskripsi aplikasi
            if ($oldDescription !== $newDescription) {
                \App\Models\ActivityLog::create([
                    'description' => $user->username . ' mengubah deskripsi di aplikasi ' . $newName,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan status aplikasi
            if ($oldStatus !== $newStatus) {
                \App\Models\ActivityLog::create([
                    'description' => $user->username . ' mengubah status di aplikasi ' . $newName,
                    'user_id' => $user->id,
                ]);
            }
        }

        return redirect()->route('applications.index')->with('success', 'Data Aplikasi berhasil disimpan.');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $appName = $application->app_name;

        $application->delete();

        // Simpan activity log
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            \App\Models\ActivityLog::create([
                'description' => $user->username . ' menghapus aplikasi ' . $appName,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('applications.index')->with('success', 'Data Aplikasi berhasil dihapus.');
    }
}
