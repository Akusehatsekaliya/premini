<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Session;

use App\Models\Film;
use App\Models\Kursi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpParser\Node\Stmt\TryCatch;

class KursiController extends Controller
{
    public function kursi(){
        $kursi = Kursi::get();
        return view('admin.kursi.kursi', compact('kursi'));
    }

    public function proses_kursi(Request $request){
        $request->validate([
            'kursi' => 'required|unique:kursis,kursi|numeric|min:1|max:30'
        ],[
            'kursi.required' => 'kursi tidak boleh kosong',
            'kursi.uniqiu' => 'kursi sudah ada',
            'kursi.min'     => 'minimal 1',
            'kursi.max'     => 'maksimal 30',
        ]);

        $kirim = Kursi::create([
            'kursi' => $request->kursi,
        ]);

        Session::flash('successTambah', 'Data berhasil ditambahkan!');

        return back();
    }

    public function update_kursi(Request $request,$id){
        $kursi = Kursi::find($id);
        $request->validate([
            'kursi' => 'required|unique:kursis,kursi|numeric|min:1|max:30'
        ],[
            'kursi.required' => 'kursi tidak boleh kosong',
            'kursi.uniqiu' => 'kursi sudah ada',
            'kursi.min'     => 'minimal 1',
            'kursi.max'     => 'maksimal 30',
        ]);

        $data = [
        'kursi' => $request->kursi,
        ];
         $kursi->update($data);

         Session::flash('successEdit', 'Data berhasil diubah!');

         return back();
    }

    public function delete_kursi(Request $request, $id)
    {

        $film = Film::where('kursi_id', $id)->first();
        try {
            $kursi = Kursi::find($id);
            if ($film) {
                throw new \Exception('Data masih di pakai');
            }

            $kursi->delete();

            Session::flash('successHapus', 'Data berhasil dihapus!');

            return back();

        } catch (\Exception $e) {
            // Tangani kesalahan yang terjadi
            // Misalnya, tampilkan pesan kesalahan atau lakukan tindakan lain yang sesuai
            return back()->with('error', $e->getMessage());
        }
    }
}
