<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Student;

// Create test students
$students = [
    ['nis' => '12345', 'name' => 'Andi Wijaya', 'email' => 'andi@sman2balige.sch.id', 'birth_date' => '2008-05-15', 'class' => 'XII MIPA 1', 'address' => 'Jl. Pendidikan No. 1, Balige'],
    ['nis' => '12346', 'name' => 'Budi Santoso', 'email' => 'budi@sman2balige.sch.id', 'birth_date' => '2008-06-20', 'class' => 'XII MIPA 2', 'address' => 'Jl. Merdeka No. 5, Balige'],
    ['nis' => '12347', 'name' => 'Citra Dewi', 'email' => 'citra@sman2balige.sch.id', 'birth_date' => '2008-07-10', 'class' => 'XII IPS 1', 'address' => 'Jl. Sudirman No. 12, Balige'],
];

foreach ($students as $student) {
    if (!Student::where('nis', $student['nis'])->exists()) {
        Student::create($student);
    }
}

echo "✅ Test students created successfully\n";
echo "Total students in database: " . Student::count() . "\n";
