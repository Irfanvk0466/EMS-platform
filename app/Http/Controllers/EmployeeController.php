<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Skill;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Show the employee listing page.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::with('skills')->latest()->get();
            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('skills', function ($employee) {
                    return $employee->skills->pluck('name')->join(', ');
                })
                ->addColumn('avatar', function ($employee) {
                    $avatarPath = $employee->avatar
                        ? asset('storage/avatars/' . $employee->avatar)
                        : asset('default-avatar.png');

                    return '<img src="' . $avatarPath . '" width="50" class="rounded">';
                })
                ->addColumn('action', function ($row) {
                    return view('employees.partials.actions', compact('row'))->render();
                })
                ->rawColumns(['avatar', 'action'])
                ->make(true);
        }
        $skills = Skill::all();
        return view('employees.index', compact('skills'));
    }
    /**
     * Store a newly created employee in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->full_name = $request->full_name;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->department = $request->department;
        $employee->designation = $request->designation;
        if ($request->hasFile('avatar')) {
            $employee->uploadAvatar($request->file('avatar'));
        }
        $employee->save();
        $employee->skills()->sync($request->skills);
        return response()->json(['success' => 'Employee added successfully!']);
    }
    /**
     * Show the form for editing the specified employee.
     */
    public function edit(string $id)
    {
        $employee = Employee::with('skills')->findOrFail($id);
        $allSkills = Skill::all();
        return response()->json([
            'id' => $employee->id,
            'full_name' => $employee->full_name,
            'email' => $employee->email,
            'mobile' => $employee->mobile,
            'department' => $employee->department,
            'designation' => $employee->designation,
            'avatar' => $employee->avatar ? asset('storage/avatars/' . $employee->avatar) : asset('path/to/default/avatar.png'),
            'skills' => $employee->skills->pluck('id')->toArray(),
            'all_skills' => $allSkills
        ]);
    }
    /**
     * Update the specified employee in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->full_name = $request->full_name;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->department = $request->department;
        $employee->designation = $request->designation;
        if ($request->hasFile('avatar')) {
            $employee->uploadAvatar($request->file('avatar'));
        }
        $employee->save();
        $employee->skills()->sync($request->skills);
        return response()->json(['success' => 'Employee updated successfully!']);
    }
    /**
     * Remove the specified employee from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->deleteAvatar();
        $employee->delete();
        return response()->json(['success' => 'Employee deleted successfully.']);
    }
}
