<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SantriController extends Controller
{

    public function index(){

        $santri = Student::where(['user_id' => Auth::id()])->get();
        

        return view('santri', ['data' => $santri]);

    }

    public function create(){

        return view('santri-create');

    }

    public function handleCreate(Request $request){
        
        $request->validate([
            'student_image' => 'image|mimes:jpeg,png,jpg,svg|max:1024',
            'student_name' => 'required',
            'student_address' => "required",
            'student_guardian' => 'required',
            'phone' => 'required|numeric',
            'student_date_entry' => 'required|date'

        ]);

        $disk = Storage::build([
            'driver' => 'local',
            'root' => '../public/images'
        ]);

        if ($request->file('student_image')) {
           
            $studentImage = $disk->put('.', $request->file('student_image'));
            $studentImage = explode('./', $studentImage);
            $studentImage = $studentImage[1];
        } else {
            $studentImage = 'default.jpg';
        }

        Student::create([
            'student_image' => $studentImage,
            'student_name' => $request->student_name,
            'student_address' => $request->student_address,
            'student_guardian' => $request->student_guardian,
            'student_phone' => $request->phone,
            'student_date_entry' => $request->student_date_entry,
            'user_id' => Auth::id()
        ]);

        Alert::success('Santri Berhasil Ditambahkan', '');

        return redirect()->back();
    }

    public function delete($id){

       Student::where(['student_id' => $id])->delete();

       Alert::success('Data Santri Berhasil Dihapus', '');

       return redirect()->back();

    }

    public function update(Request $request,$id){
        
        $student = Student::find($id);

        $request->validate([
            'student_image' => 'image|mimes:jpeg,png,jpg,svg|max:1024',
            'student_name' => 'required',
            'student_address' => 'required',
            'student_guardian' => 'required',
            'student_phone' => 'required',
            'student_date_entry' => 'required|date',
            'student_date_out' => 'nullable|date',
            
        ]);

        $disk = Storage::build([
            'driver' => 'local',
            'root' => '../public/images'
        ]);

        if($request->file('student_image')){
            $student->student_image === 'default.jpg' ? false : $disk->delete("./$student->student_image");
            $studentImage = $disk->put('.', $request->file('student_image'));
            $studentImage = explode('./', $studentImage);
            $studentImage = $studentImage[1];
        } else {
            $studentImage = 'default.jpg';
        }

        $student->student_image = $studentImage;
        $student->student_name = $request->student_name;
        $student->student_address = $request->student_address;
        $student->student_guardian = $request->student_guardian;
        $student->student_phone = $request->student_phone;
        $student->student_date_entry = $request->student_date_entry;
        if($request->student_date_out){
            $student->student_date_out = $request->student_date_out;

        } else {
            $student->student_date_out = null;
        }
        $student->save();
        Alert::success('Data Santri Successfully Edit', '');
        return redirect()->to('/santri');
        

    }
}
