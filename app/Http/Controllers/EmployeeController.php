<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;

class EmployeeController extends Controller
{
    public function index()
    {
        $data = Employee::all();
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
}