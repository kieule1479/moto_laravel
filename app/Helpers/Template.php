<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class Template
{
    public static function checkbox()
    {
        $xhtml = sprintf('<div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="checkbox-3" name="checkbox[]"
                                    value="3">
                                <label for="checkbox-3" class="custom-control-label"></label>
                            </div>');
        return $xhtml;
    }
    public static function showItemsIcon($controllerName, $id, $status, $name)
    {
        $btn = 'btn-success';
        $fa  = 'fa-check';
        if ($status == 'inactive') {
            $btn = 'btn-danger';
            $fa  = 'fa-minus';
        }
        $link = route($controllerName.'/'.$name.'', ['status'=>$status, 'id'=>$id]);

        $xhtml = sprintf(
            '<a href="%s" class="my-btn-state rounded-circle btn btn-sm %s">
                <i class="fas %s"></i>
            </a>',
            $link,
            $btn,
            $fa,
        );
        return $xhtml;
    }
    public static function showItemsHistory($by, $time)
    {
        $xhtml = sprintf(
            '<p class="mb-0 history-by"><i class="far fa-user"></i> %s</p>
             <p class="mb-0 history-time"><i class="far fa-clock"></i> %s</p>',
            $by,
            date(Config::get('zvn.format.long_time'), strtotime($time)),
        );
        return $xhtml;
    }

    public static function showButtonsAction($controllerName, $id)
    {

        $buttonInArea = Config::get('zvn.config.button'); // Cần có những nút gì
        $tmpButton    = Config::get('zvn.templates.button');

        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : "default";
        $listButton     = $buttonInArea[$controllerName];

        $xhtml = '';
        foreach ($listButton as $btn) {

            $currentButton = $tmpButton[$btn];
            $link = route($controllerName. $currentButton['route-name'], ['id'=>$id]);
            $xhtml .= sprintf(
                ' <a href="%s" class="rounded-circle btn btn-sm %s" title="%s">
                    <i class="fas %s"></i>
                </a>',
                $link,
                $currentButton['class'],
                $currentButton['title'],
                $currentButton['icon'],
            );
        }
        return $xhtml;
    }



    //===== SHOW BUTTON FILTER ======
    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentFilterStatus, $paramsSearch)
    {
        $tmplStatus = Config::get('zvn.templates.status');
        $xhtml      = null;

        if (count($itemsStatusCount) > 0) {

            array_unshift($itemsStatusCount, [
                'count'  => array_sum(array_column($itemsStatusCount, 'count')),
                'status' => 'all'
            ]);

            foreach ($itemsStatusCount as $item) {

                $statusValue           = $item['status'];
                $statusValue           = array_key_exists($statusValue, $tmplStatus) ? $statusValue : 'default';
                $currentTemplateStatus = $tmplStatus[$statusValue];
                $link                  = route($controllerName) . "?filter_status=" . $statusValue;

                if ($paramsSearch['value'] != '') {
                    $link .= "&search_field=" . $paramsSearch['field'] . "&search_value=" . $paramsSearch['value'];
                }

                $class = ($currentFilterStatus == $statusValue) ? 'btn-info' : 'btn-secondary';


                $xhtml .= sprintf('<a href="%s" type="button" class="mr-1 btn btn-sm %s">
                            %s  <span class="badge badge-pill badge-light">%s</span>
                            </a>', $link, $class, $currentTemplateStatus['name'], $item['count']);
            }
        }
        return $xhtml;
    }

    //======== SHOW SELECT BOX =========
    public static function showSelectBox($controllerName, $paramsSearch)
    {

        $xhtml             = null;
        $tmpField          = Config::get('zvn.templates.search2Val');

        $fieldInController = Config::get('zvn.config.search2Val');
        $controllerName    = (array_key_exists($controllerName, $fieldInController)) ? $controllerName : 'default';
        $xhtmlField        = null;
        // '<option value="default" selected="">- Select Group ACP -</option>
        foreach ($fieldInController[$controllerName] as $field) {
            $value ='default';
            if($field=='yes'){
                $value = 'true';
            }else if($field=='no'){
                $value = 'false';
            }

            $xhtml .= sprintf(
                '<option value="'. $value.'">'. $tmpField[$field]['name'].'</option>'
            );
        }
        return $xhtml;
    }

    //===== SHOW AREA SEARCH ======
    public static function showAreaSearch($controllerName, $paramsSearch)
    {
        $xhtml             = null;
        $tmpField          = Config::get('zvn.templates.search');
        $fieldInController = Config::get('zvn.config.search');
        $controllerName    = (array_key_exists($controllerName, $fieldInController)) ? $controllerName : 'default';
        $xhtmlField        = null;

        foreach ($fieldInController[$controllerName] as $field) {
            $xhtmlField .= sprintf(
                '<li><a href="#" class="select-field" data-field="%s">%s </a></li>',
                $field,
                $tmpField[$field]['name']
            );
        }

        $searchField = (in_array($paramsSearch['field'], $fieldInController[$controllerName])) ? $paramsSearch['field'] : 'all';

        $xhtml = sprintf(
            ' <div class="input-group">
                <div class="input-group-prepend input-group-sm">
                    <button type="button " class="btn btn-default dropdown-toggle btn-active-field custom-select-sm" data-toggle="dropdown" aria-expanded="false">
                        %s <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        %s
                    </ul>
                </div>

                <input type="text" name="search_value" value="%s" class="form-control custom-select-sm">
                <input type="hidden" name="search_field" value="%s">
                <div class="input-group-append">
                    <button id="btn-clear-search" type="button" class="btn-sm btn-danger custom-select-sm" style="margin-right: 0px">Xóa tìm kiếm</button>
                    <button id="btn-search" type="button" class="btn btn-sm btn-info custom-select-sm">Tìm kiếm</button>
                </div>

            </div>',
            $tmpField[$searchField]['name'],
            $xhtmlField,
            $paramsSearch['value'],
            $searchField
        );
        return $xhtml;
    }
}
