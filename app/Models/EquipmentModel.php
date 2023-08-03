<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EquipmentModel extends Model
{
    use HasFactory;
    protected $table = 'equipment';
    protected $primaryKey = 'equipment_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToSingleEquipment($equipment_id)
    {
        return EquipmentModel::find($equipment_id);
    }

    // TO GET ALL ACTIVE EQUIPMENT
    static function ToGetAllActiveEquipment($company_ID)
    {
        $records = EquipmentModel::select('*',)
                ->where('equipment_status', 1)
                ->where('company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no Equipment !';
        }
        return $records;
    }

    // TO GET ALL DELETE EQUIPMENT
    static function ToGetAllDeleteEquipment($company_ID)
    {
        $records = EquipmentModel::select('*',)
                ->where('equipment_status', 2)
                ->where('company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no deleted Equipment !';
        }
        return $records;
    }

    // TO GET ALL SUSPEND EQUIPMENT
    static function ToGetAllSuspendEquipment($company_ID)
    {
        $records = EquipmentModel::select('*',)
                ->where('equipment_status', 3)
                ->where('company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no deleted Equipment !';
        }
        return $records;
    }

}
