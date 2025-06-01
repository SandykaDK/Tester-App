<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class DaftarDeveloperController extends Controller
{
    public function index(Request $request)
    {
        $query = Developer::query();

        if ($request->has('dev_name') && $request->dev_name != '') {
            $query->where('dev_name', 'like', '%' . $request->dev_name . '%');
        }

        if ($request->has('dev_email') && $request->dev_email != '') {
            $query->where('dev_email', 'like', '%' . $request->dev_email . '%');
        }

        if ($request->has('dev_app') && $request->dev_app != '') {
            $query->whereHas('application', function ($q) use ($request) {
                $q->where('app_name', 'like', '%' . $request->dev_app . '%');
            });
        }

        $itemsPerPage = $request->get('items_per_page', 10);
        $developers = $query->paginate($itemsPerPage);

        return view('Master.DaftarDeveloper.DaftarDeveloper', compact('developers'));
    }

    public function create()
    {
        $applications = Application::all();
        return view('Master.DaftarDeveloper.Create', compact('applications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dev_name' => 'required|string|max:255',
            'dev_email' => 'required|string',
            'dev_app' => 'required|array',
        ]);

        $developer = Developer::create($request->only(['dev_name', 'dev_email']));
        $developer->applications()->syncWithPivotValues($request->dev_app, ['created_at' => now(), 'updated_at' => now()]);

        // Activity log untuk create developer
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            ActivityLog::create([
                'description' => $user->username . ' menambahkan developer ' . $developer->dev_name,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('developers.index')->with('success', 'Developer created successfully.');
    }

    public function edit($id)
    {
        $developer = Developer::findOrFail($id);
        $applications = Application::all();
        return view('Master.DaftarDeveloper.Edit', compact('developer', 'applications'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'dev_name' => 'required|string|max:255',
            'dev_email' => 'required|string',
            'dev_app' => 'required|array',
        ]);

        $developer = Developer::findOrFail($id);
        $oldName = $developer->dev_name;
        $oldEmail = $developer->dev_email;
        $oldApps = $developer->applications()->pluck('applications.id')->toArray();

        $developer->update($request->only(['dev_name', 'dev_email']));
        $developer->applications()->syncWithPivotValues($request->dev_app, ['updated_at' => now()]);

        // Activity log untuk update developer
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            // Log perubahan nama developer
            if ($oldName !== $developer->dev_name) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah nama developer ' . $oldName . ' menjadi ' . $developer->dev_name,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan email developer
            if ($oldEmail !== $developer->dev_email) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah email developer ' . $developer->dev_name,
                    'user_id' => $user->id,
                ]);
            }
            // Log perubahan aplikasi developer
            $newApps = $developer->applications()->pluck('applications.id')->toArray();
            if ($oldApps != $newApps) {
                ActivityLog::create([
                    'description' => $user->username . ' mengubah aplikasi yang dikerjakan oleh developer ' . $developer->dev_name,
                    'user_id' => $user->id,
                ]);
            }
        }

        return redirect()->route('developers.index')->with('success', 'Developer updated successfully.');
    }

    public function destroy($id)
    {
        $developer = Developer::findOrFail($id);
        $devName = $developer->dev_name;
        $developer->delete();

        // Activity log untuk hapus developer
        $user = Auth::user();
        if ($user && isset($user->username) && isset($user->id)) {
            ActivityLog::create([
                'description' => $user->username . ' menghapus developer ' . $devName,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('developers.index')->with('success', 'Developer deleted successfully.');
    }
}
