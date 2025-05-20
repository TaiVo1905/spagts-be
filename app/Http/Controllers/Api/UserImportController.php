<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BaseController;


class UserImportController extends Controller {
    // Import user từ file Excel
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,csv|max:5120',
    ]);

    try {
        $uploadedFile = $request->file('file');
        $ext = $uploadedFile->getClientOriginalExtension();
        $fileName = uniqid('import_') . '.' . $ext;

        Storage::makeDirectory('imports');

        $filePath = $uploadedFile->storeAs('imports', $fileName);
        if (!$filePath) {
            throw new \Exception('Không lưu được file import!');
        }
        $absolutePath = storage_path('app/private/' . $filePath);
        (new UsersImport)->import($absolutePath);

        return response()->json(['message' => 'Import successful']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Import failed: ' . $e->getMessage()], 422);
    }
}

    public function downloadTemplate()
    {
        $path = storage_path('app/templates/user_import_template.xlsx');
        
        if (!file_exists($path)) {
            Storage::makeDirectory('templates');
            
            SimpleExcelWriter::create($path)
                ->addHeader([
                    'name',
                    'email',
                    'roles',
                    'password'
                ])
                ->addRow([
                    'John Doe',
                    'john@example.com',
                    'Student',
                    'password123'
                ]);
        }
        
        return response()->download($path, 'user_import_template.xlsx');
    }
}