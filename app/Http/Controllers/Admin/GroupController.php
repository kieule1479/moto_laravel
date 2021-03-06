<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\GroupModel as MainModel;
use App\Http\Requests\SliderRequest as MainRequest;



class GroupController extends Controller
{

    private $pathViewController = 'admin.pages.group.';
    private $controllerName = 'group';
    private $model;
    private $params = [];

    //===== __CONSTRUCT ======
    public function __construct()
    {
        // View::share('controllerName', $this->controllerName);
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        view()->share('controllerName', $this->controllerName);
    }

    //===== INDEX ======
    public function index(Request $request)
    {

        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field', '');
        $this->params['search']['value'] = $request->input('search_value', '');
        $this->params['filter']['group_acp'] = $request->input('filter_group_acp', '');

        $items = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        $itemsStatusCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']);

        return view($this->pathViewController . 'index', [
            'items' => $items,
            'itemsStatusCount' => $itemsStatusCount,
            'params' => $this->params,
        ]);
    }

    //===== FORM ======
    public function form(Request $request)
    {

        $item = null;
        if ($request->id != null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        return view($this->pathViewController . 'form', [
            'item' => $item,

        ]);
    }

    //===== SAVE ======
    // public function save(MainRequest $request)
    // {

    //     if($request->method() =='POST'){
    //         $params = $request->all();// l???y t???t c??? ph???n t??? ???????c POST qua;

    //         $task   = 'add-item';
    //         $notify = 'Th??m ph???n t??? th??nh c??ng !';

    //         if($params['id'] != null){
    //             $task   = 'edit-item';
    //             $notify = 'C???p nh???p ph???n t??? th??nh c??ng !';
    //         }

    //         $this->model->saveItem($params, ['task'=>$task]);
    //         return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
    //     }
    // }

    //===== STATUS ======
    public function status(Request $request)
    {

        $params["currentStatus"] = $request->status;
        $params["id"] = $request->id;

        $this->model->saveItem($params, ['task' => 'change-status']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'C???p nh???p tr???ng th??i th??nh c??ng !!!');
    }
    public function changeGroupACP(Request $request)
    {

        $params["currentGroupACP"] = $request->group_acp;
        $params["id"] = $request->id;

        $this->model->saveItem($params, ['task' => 'change-group-acp']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'C???p nh???p tr???ng th??i th??nh c??ng !!!');
    }

    //===== DELETE ======
    public function delete(Request $request)
    {

         $params["id"] = $request->id;

        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Xo?? ph???n t??? th??nh c??ng th??nh c??ng !!!');
    }
}
