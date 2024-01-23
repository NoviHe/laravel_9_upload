<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadFileController extends Controller
{
    function index()
    {
        $datas = Upload::all();
        return view('main', compact('datas'));
    }
    function store(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,xls,doc,docs,txt|max:1000',
        ]);

        // menentukan nama file yang akan di simpan disini contoh menggunakan timestamp
        $fileName = time() . '.' . $request->file->extension();

        // cek apakah directory / folder sudah ada
        //disini menggunakan ! supaya bila belum ada folder maka akan mengembalikan true
        if (!file_exists(public_path('uploads'))) {
            // fungsi bawaan php untuk membuat folder
            mkdir(public_path('uploads'), 0755);
        }

        $request->file->move(public_path('uploads'), $fileName);

        $save = Upload::create(['name' => $fileName]);
        if ($save) {
            return redirect()->route('upload.index')->with('success', 'Berhasil di Upload');
        }
        return redirect()->route('upload.index')->with('failed', 'Gagal di Upload');
    }

    function delete($id)
    {
        $file = Upload::findOrFail($id);
        // Hapus file di folder
        File::delete(public_path('uploads' . '/' . $file->name));
        // hapsu fule di db
        $file->delete();
        return redirect()->route('upload.index')->with('success', 'Berhasil di Hapus');
    }

    function download($id)
    {
        $file = Upload::findOrFail($id);
        return response()->download(public_path('uploads') . '/' . $file->name);
    }
}
