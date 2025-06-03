<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class UsersImport
{
    public function import($filePath)
{
    $reader = SimpleExcelReader::create($filePath);
    $rows = $reader->getRows();

    $errors = [];
    $importedCount = 0;

    foreach ($rows as $index => $row) {
        try {
            $validator = Validator::make($row, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'roles' => 'required|string|in:Admin,Teacher,Student',
                'password' => 'required|min:6',
            ]);
            if ($validator->fails()) {
                $errors[] = "Row " . ($index + 2) . ": " . implode(', ', $validator->errors()->all());
                continue;
            }

            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'roles' => $row['roles'],
                'password' => Hash::make($row['password']),
            ]);

            $importedCount++;
        } catch (\Exception $e) {
            $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
        }
    }

    if (!empty($errors)) {
        throw ValidationException::withMessages([
            'import' => $errors
        ]);
    }

    return $importedCount;
}
} 