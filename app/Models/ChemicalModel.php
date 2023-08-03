<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChemicalModel extends Model
{
    use HasFactory;
    protected $table = 'chemical';
    protected $primaryKey = 'chemical_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToSingleChemical($equipment_id)
    {
        return ChemicalModel::find($equipment_id);
    }

    // TO GET ALL ACTIVE CHEMICAL
    static function ToGetAllActiveChemical($company_ID)
    {
        $records = ChemicalModel::select('*',)
                ->where('chemical_status', 1)
                ->where('company_id', $company_ID)
                ->paginate(15);
        return $records;
    }

    // TO GET ALL THE DELETED CHEMICAL
    static function ToGetAllDeleteChemical($company_ID)
    {
        $records = ChemicalModel::select('*',)
                ->where('chemical_status', 2)
                ->where('company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no deleted Chemical !';
        }
        return $records;
    }

    // TO GET ALL THE SUSPEND CHEMICAL
    static function ToGetAllSuspendChemical($company_ID)
    {
        $records = ChemicalModel::select('*',)
                ->where('chemical_status', 3)
                ->where('company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no deleted Chemical !';
        }
        return $records;
    }
}
