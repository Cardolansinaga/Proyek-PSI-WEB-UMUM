<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $search = $request->get('search');
        $classFilter = $request->get('class');

        $q = Student::query();
        if ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($classFilter) {
            $q->where('class', $classFilter);
        }

        $paginated = $q->orderBy('name')->paginate($perPage)->appends($request->query());
        return response()->json($paginated);
    }

    public function show($id)
    {
        return response()->json(Student::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|unique:students,nis',
            'name' => 'required|string',
            'email' => 'nullable|email',
            'birth_date' => 'nullable|date',
            'class' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        try {
            $student = Student::create($validator->validated());
            if ($request->wantsJson()) {
                return response()->json($student, 201);
            }
            return redirect()->route('admin.kesiswaan.index')->with('status', 'Siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Server error', 'error' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Server error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|unique:students,nis,'.$student->id,
            'name' => 'required|string',
            'email' => 'nullable|email',
            'birth_date' => 'nullable|date',
            'class' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        try {
            $student->update($validator->validated());
            if ($request->wantsJson()) {
                return response()->json($student);
            }
            return redirect()->route('admin.kesiswaan.index')->with('status', 'Data siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Server error', 'error' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Server error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(null, 204);
    }
}
