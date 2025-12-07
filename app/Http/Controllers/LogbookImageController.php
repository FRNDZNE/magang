<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogbookImageRequest;
use App\Models\LogbookImage;
use App\Models\Logbook;
use App\Models\Intern;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class LogbookImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Intern $intern,Logbook $logbook)
    {
        $images = LogbookImage::where('logbook_id',$logbook->id)->get();
        return view('logbook-image.index', compact('logbook','images','intern'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Intern $intern, Logbook $logbook, LogbookImageRequest $request)
    {
        try {
            $data = $request->validated();
            $filename = Str::uuid() . '.jpg';
            $path = "logbook/" . $filename;
            $manager = new ImageManager(new Driver());
            $image = $manager->read($data['image']);
            $image->resize(
                1200,                // max width
                null,                // height auto
                function ($constraint) {
                    $constraint->aspectRatio(); // jaga rasio
                    $constraint->upsize();      // jangan membesar dari gambar asli
                }
            );
            $image->toJpeg(60)->save(public_path($path));
            LogbookImage::create([
                'logbook_id' => $logbook->id,
                'image_path' => $path,
            ]);
            return redirect()->back()->with('success','Berhasil Upload Gambar');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function update(LogbookImageRequest $request, Intern $intern, Logbook $logbook, LogbookImage $logbookImage)
    {
        try {
            // Jika tidak ada file baru, kembalikan tanpa error (atau sesuaikan kebutuhanmu)
            if (! $request->hasFile('image')) {
                return redirect()->back()->with('info', 'Tidak ada gambar baru yang diunggah');
            }

            // Hapus file lama jika ada (pakai public_path)
            if (file_exists(public_path($logbookImage->image_path))) {
                unlink(public_path($logbookImage->image_path));
                return 'file berhasil dihapus';
            }

            // Nama file baru
            $filename = Str::uuid() . '.jpg';
            $path = "logbook/" . $filename;

            // Proses gambar baru (resize + compress)
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image')); // gunakan request->file('image')
            $image->resize(
                1200, // kalau mau 1200 seperti saran sebelumnya; ganti ke 120 jika memang mau kecil
                null,
                function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                }
            );
            $image->toJpeg(60)->save(public_path($path));

            // Update DB
            $logbookImage->update([
                'image_path' => $path,
            ]);

            return redirect()->back()->with('success', 'Berhasil Mengubah Gambar');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Intern $intern, Logbook $logbook, LogbookImage $logbookImage)
    {
        try {
            $fullPath = public_path($logbookImage->image_path);

            // Hapus file fisik dengan keamanan maksimal
            if ($logbookImage->image_path && file_exists($fullPath) && is_file($fullPath)) {
                unlink($fullPath);
            }

            // Hapus data di database
            $logbookImage->delete();

            return redirect()->back()->with('success', 'Berhasil Menghapus Gambar');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


}
