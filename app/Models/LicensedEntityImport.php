<?php namespace App\Models;

use App\Models\LicensedEntity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class LicensedEntityImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {
      
        foreach ($rows as $key => $row) {
            // if($key > 0) dd($row['date_of_application']);
            if(isset($row['name'])){
                LicensedEntity::create([
                    "name" =>isset($row['name'])? $row['name'] : '',
                    "principal_officer" => isset($row['principal_officer'])? $row['principal_officer'] : '',
                    "email" => isset($row['email'])? $row['email'] : '',
                    "phone" => isset($row['phone'])? $row['phone'] : '',
        
                    "telephone" =>isset($row['telephone'])? $row['telephone'] : '' , // empty
                    "fax" =>isset($row['fax'])? $row['fax'] : '' , // empty
                    "website" =>isset($row['website'])? $row['website'] : '' ,  // empty
                    "region" =>isset($row['region'])? $row['region'] : '' ,  // empty
                    "class_of_business" =>isset($row['class_of_business'])? $row['class_of_business'] : '' , //class_of_business('Reinsurance' 'Life' Non-Life') 
                    "license_type" =>isset($row['license_type'])? $row['license_type'] : '' , //license_type (Perpetual , 3 years)
                    "active" =>isset($row['status'])? ((strpos(trim(strtolower($row['status'])), "active") !== false) ? 1:0) : 0, 
                    //"address" =>isset($row['address'])? $row['address'] : '' , 
                    "address" =>isset($row['physical_address'])? ($row['physical_address']) : (isset($row['address'])? $row['address'] : ''), 
                    "status" =>isset($row['status'])? $row['status'] : '' , 
        
                    "category_id" => $GLOBALS['category_id'], 

		           "principal_insurer_1" => isset($row['principal_insurer'])? ($row['principal_insurer']) : (isset($row['principal_insurer_1'])? $row['principal_insurer_1'] : ''), 
                   // "principal_insurer_1" =>isset($row['principal_insurer_1'])? $row['principal_insurer_1'] : '', 
                    "principal_insurer_2" =>isset($row['principal_insurer_2'])? $row['principal_insurer_2'] : '', 
                    "principal_insurer_3" =>isset($row['principal_insurer_3'])? $row['principal_insurer_3'] : '', 
                    "date_of_application" =>isset($row['date_of_application'])? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['date_of_application'])) : '', 
                    "date_of_license" =>isset($row['date_of_license'])? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['date_of_license']))->format('Y-m-d') : '', 
                    "number_of_license" =>isset($row['number_of_license'])? $row['number_of_license'] : '', 
                    "number_of_employees" =>isset($row['number_of_employees'])? $row['number_of_employees'] : '' , 
                    "district" =>isset($row['district'])? $row['district'] : '' , 
             
                    "new_renewal" =>isset($row['new_renewal'])? $row['new_renewal'] : '' , 
                    "country" =>isset($row['country'])? $row['country'] : '' , 
                ]);
             }
        }
    }
}



?>










