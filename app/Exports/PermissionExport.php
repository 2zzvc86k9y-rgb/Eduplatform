<?php

namespace App\Exports;
use Spatie\Permission\Models\Permission;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class PermissionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Permission::select('name','group_name')->get();
    }
}
