<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminModel;
use Illuminate\Support\Str;


class SliderModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'slider';
        $this->folderUpload        = 'slider';
        $this->fieldSelectAccepted = ['id', 'name'];
        $this->crudNotAccepted     = ['_token', 'thumb_current'];
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-list-items') {

            $query = $this->select('id', 'name', 'picture', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');

            if ($params['filter']['status'] != 'all') {
                $query->where('status', '=', $params['filter']['status']);
            }
            if ($params['filter']['group_acp'] != '') {
                $value = $params['filter']['group_acp'] == 'true' ? 'active': 'inactive';
                $query->where('group_acp', '=', $value);
            }

            if ($params['search']['value'] != '') {
                if ($params['search']['field'] == 'all') {

                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSelectAccepted as $column) {
                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });

                } else if (in_array($params['search']['field'], $this->fieldSelectAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }
            $result = $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }


        return $result;
    }

    public function countItems($params = null, $options = null)
    {

        $result = null;
        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('count(id) as count, status'));


            if ($params['search']['value'] != '') {
                if ($params['search']['field'] == 'all') {

                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSelectAccepted as $column) {
                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSelectAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }
            if ($params['filter']['group_acp'] != '') {
                $value = $params['filter']['group_acp'] == 'true' ? 'active' : 'inactive';
                $query->where('group_acp', '=', $value);
            }
        }
        $result = $query->get()->toArray();

        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == 'active') ? 'inactive' : 'active';
            self::where('id', $params['id'])->update(['status' => $status]);
        }
        if ($options['task'] == 'change-group-acp') {

            $group_acp = ($params['currentGroupACP'] == 'active') ? 'inactive' : 'active';
            self::where('id', $params['id'])->update(['group_acp' => $group_acp]);
        }

        if ($options['task'] == 'add-item') {


            $params['created_by'] = 'hailan';
            $params['created']    = date('Y-m-d');
            $params['thumb']      = $this->uploadThumb($params['thumb']);

            self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            if (!empty($params['thumb'])) {
                $this->deleteThumb($params['thumb_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }

            $params['modified_by'] = 'hailan';
            $params['modified']    = date('Y-m-d');
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering', 'privilege_id', 'picture')->where('id', $params['id'])->first();
        }
        // if ($options['task'] == 'get-thumb') {
        //     $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        // }
        return $result;
    }

    public function deleteItem($params = null, $options = null)
    {

        if ($options['task'] == 'delete-item') {

            // $item = self::getItem($params, ['task' => 'get-thumb']);
            // $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }
}
