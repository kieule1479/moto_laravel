<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class AdminModel extends Model
{

    protected $table               = '';
    protected $folderUpload        = '';
    public    $timestamps          = false;
    const     CREATED_AT           = 'creation';
    const     UPDATED_AT           = 'modified';
    protected $fieldSelectAccepted = [
        'id',
        'name',

    ];
    protected $crudNotAccepted = [
        '_token',
        'thumb_current',

    ];




    public function deleteThumb($thumbName)
    {

        Storage::disk('zvn_storage_image')->delete($this->folderUpload . '/' . $thumbName);

    }
    public function uploadThumb($thumbObj)
    {
        $thumbName = Str::random(10) . '.' . $thumbObj->clientExtension();
        $thumbObj->storeAs($this->folderUpload, $thumbName, 'zvn_storage_image');
        return $thumbName;

    }

    public function prepareParams($params){
       return array_diff_key($params, array_flip($this->crudNotAccepted));

    }
}
