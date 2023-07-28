<?php

namespace App\Http\Controllers;

use App\Exports\student\ExportStudents;
use App\Http\Requests\student\createStudent;
use App\Http\Requests\student\updateStudent;
use App\Imports\student\ImportStudent;
use App\Imports\student\ImportStudents;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = array();
        //$this->data['data'] = StudentModel::all();
        //$this->data['data'] = StudentModel::paginate(10);
        $this->data['data'] = StudentModel::orderBy('id', 'DESC')->paginate(10);
        return view('student.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data = array();
        return view('student.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createStudent $createStudent)
    {
        //dd($createStudent->all());
        $arrInsert              = array();
        $arrInsert['name']      = $createStudent->name;
        $arrInsert['email']     = $createStudent->email;
        $arrInsert['pincode']   = $createStudent->pincode;
        $arrInsert['location']  = $createStudent->location;
        $return = StudentModel::create($arrInsert);
        if($return->id){
            return redirect('/student')->with('success_msg', 'Student added successfully!');
        }
        else{
            return redirect('/student/create')->with('error_msg', 'Something wnt wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentModel $sid)
    {
        $this->data = array();
        $this->data['edit'] = $sid;
        return view('student.update', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateStudent $updateStudent, $id)
    {
        $arrUpdate              = array();
        $arrUpdate['name']      = $updateStudent->name;
        $arrUpdate['email']     = $updateStudent->email;
        $arrUpdate['pincode']   = $updateStudent->pincode;
        $arrUpdate['location']  = $updateStudent->location;
        $return = StudentModel::where('id', $id)->update($arrUpdate);
        //dd($return);
        if($return){
            return redirect('/student')->with('success_msg', 'Student updated successfully!');
        }
        else{
            return redirect('/student/create')->with('error_msg', 'Something wnt wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = StudentModel::find($id)->delete();
        if($delete == true){
            return redirect('/student')->with('success_msg', 'Student deleted successfully!');
        }
        else{
            return redirect('/student')->with('error_msg', 'Something wnt wrong!');
        }
    }

    public function import()
    { 
        $this->data = array(); 
        $this->data['excelFields'] = "Name | Email | Location | Pincode";
        return view('student.import', $this->data);
    }

    public function import_store(Request $request)
    { 
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        
        $import = new ImportStudents;
        Excel::import($import, $request->file);  
        $count = $import->newrows;
        return redirect('/student')->with('success_msg', $count .' record(s) added successfully!');
    }

    public function export(Request $request)
    { 
        $data = StudentModel::all();
        return Excel::download(new ExportStudents($data), 'Students.xlsx');
    } 
}
