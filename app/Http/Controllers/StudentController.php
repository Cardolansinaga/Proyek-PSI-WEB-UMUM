<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'search' => ['nullable', 'string', 'max:120'],
            'class' => ['nullable', 'string', 'max:120'],
        ]);
        $perPage = (int) ($filters['per_page'] ?? 15);
        $search = trim((string) ($filters['search'] ?? ''));
        $classFilter = trim((string) ($filters['class'] ?? ''));

        $q = Student::query();
        if ($search !== '') {
            $q->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($classFilter !== '') {
            $q->where('class', $classFilter);
        }

        $paginated = $q->orderBy('name')->paginate($perPage)->appends($request->query());
        return response()->json($paginated);
    }

    public function show(int $id)
    {
        return response()->json(Student::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => ['required', 'string', 'max:40', 'unique:students,nis'],
            'name' => ['required', 'string', 'max:160'],
            'email' => ['nullable', 'email', 'max:160'],
            'birth_date' => ['nullable', 'date'],
            'class' => ['nullable', 'string', 'max:120'],
            'address' => ['nullable', 'string'],
        ]);
        $student = Student::create($data);

        if ($request->wantsJson()) {
            return response()->json($student, 201);
        }

        return redirect()->route('admin.kesiswaan.index')->with('status', 'Siswa berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->validate([
            'nis' => ['required', 'string', 'max:40', 'unique:students,nis,'.$student->id],
            'name' => ['required', 'string', 'max:160'],
            'email' => ['nullable', 'email', 'max:160'],
            'birth_date' => ['nullable', 'date'],
            'class' => ['nullable', 'string', 'max:120'],
            'address' => ['nullable', 'string'],
        ]);
        $student->update($data);

        if ($request->wantsJson()) {
            return response()->json($student);
        }

        return redirect()->route('admin.kesiswaan.index')->with('status', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(null, 204);
    }
}
