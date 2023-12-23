<?php
namespace App\Imports;

use App\Models\employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {   
        // this to validate the phone cell if the user change the column name 
        $phone_column = ['phone', 'phone_number', 'cell_phone']; 
        $keys = array_keys($row);
        //dd($keys);
        $phone_header = array_map('strtolower', $keys);
        $phone = null;
        foreach ($phone_column as $columnName) {
            $index = array_search($columnName,$phone_header);
            //dd($index);
            if ($index !== false && !empty($row[array_keys($row)[$index]])) {
                $phone =$row[array_keys($row)[$index]];
                break;
            }
        }
        
        //dd($phone);
         // Finding if the email of the employee is exist or not
         $emp_email = employee::where('email', $row['email'])->first();
         if ($emp_email) {      // If the record exists it will update the name and phone_number fields
             $emp_email->update([
                 'full_name' => $row['name'],
                 'phone_number' =>  $phone,
             ]);
            }  else{      
                return new employee([
                    'full_name' => $row['name'],
                    'phone_number' => $phone,
                    'email' => $row['email'],
                ]);
            }
    }
}