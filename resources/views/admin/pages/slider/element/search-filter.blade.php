@php


use App\Helpers\Template as Template;

$xhtmlButtonFilter = Template::showButtonFilter($controllerName, $itemsStatusCount, $params['filter']['status'],$params['search']);

$xhtmlAreaSearch = Template::showAreaSearch($controllerName, $params['search']);
$xhtmlSearch2Val = Template::showSelectBox($controllerName, $params['search']);
$linkGroup = route('group');


@endphp

<!-- Search & Filter -->

<div class="card card-info card-outline">
    <div class="card-header">
        <h6 class="card-title">Search & Filter</h6>
        <div class="card-tools">
             <a href="{{ $linkGroup }}" class="btn btn-tool"><i class="fas fa-sync"></i></a>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="mb-1">{!!$xhtmlButtonFilter !!}</div>

            <div class="mb-1">
                <select id="filter_groupacp" name="filter_groupacp" class="custom-select custom-select-sm mr-1"
                    style="width: unset">
                    {{-- <option value="default" selected="">- Select Group ACP -</option>
                    <option value="false">No</option>
                    <option value="true">Yes</option> --}}
                {!!$xhtmlSearch2Val !!}

                </select>
            </div>

            <div class="mb-1">{!!$xhtmlAreaSearch !!}</div>

        </div>
    </div>
</div>
