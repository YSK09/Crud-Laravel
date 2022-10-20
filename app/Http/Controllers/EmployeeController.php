<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use PDF;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search'))
        {
            $data = Employee::where('nama','LIKE','%' .$request->search.'%')->paginate(3);
        }else{
            $data = Employee::paginate(3);
        }

        return view('datapegawai',compact('data'));
    }

    public function tambahpegawai()
    {
        return view('tambahdata');
    }

    public function insertdata(Request $request)
    {
        $data = Employee::create($request->all());

        if($request->hasFile('image')) {
            $request->file('image')->move('imagepegawai/',$request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('pegawai')->with('success','Data Berhasil di Tambahkan');
    }

    public function tampilkandata($id)
    {
        $data = Employee::find($id);


        return view('tampildata',compact('data'));

    }

    public function updatedata(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());
        if($request->hasFile('image')) {
            $request->file('image')->move('imagepegawai/',$request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil Di Update');
    }

    public function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();

        return redirect()->route('pegawai')->with('success', 'Data Berhasil di Hapus');
    }

    public function exportpdf()
    {
        $data = Employee::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');

        return $pdf->download('Datawaifu.pdf');
    }
}