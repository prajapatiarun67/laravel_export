<?php

namespace App\Imports\student;

use App\Models\StudentModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;

class ImportStudents implements ToCollection, WithStartRow
{
    use Importable;
    public $newrows = 0;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $key => $row)
        {
           if(count($row) != 4)
           {
               continue;
           }

           $name        = trim($row[0]); 
           $email       = trim($row[1]); 
           $location    = trim($row[2]); 
           $pincode     = trim($row[3]); 

           

           if( empty($name) || empty($email) || empty($location) || empty($pincode)){
               continue;
           }
           

           if( 
            ! preg_match('/^[a-zA-Z][a-zA-Z0-9 \.]+$/', $name) || ! preg_match('/^[a-zA-Z][a-zA-Z0-9 \.]+$/', $location) || ! preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $email) || ! preg_match('/^[0-9]{6}+$/', $pincode)){
            continue;
        }
 
            $exist_email = DB::table('student')->select('id')
                    ->where('email', $email)
                    ->where('deleted_at', NULL)->get(); 

            if(count($exist_email)) {
                continue;
            } 
         
           

           StudentModel::create([
               'name' => $name, 
               'email' => $email, 
               'location' => $location, 
               'pincode' => $pincode, 
           ]); 

           ++$this->newrows;
       }

    }

    public function startRow(): int
    {
        return 2;
    } 
}
