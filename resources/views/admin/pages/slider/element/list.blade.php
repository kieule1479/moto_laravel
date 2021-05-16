@php
use App\Helpers\Template;
use App\Helpers\Highlight;
$linkGroup = route('group');

@endphp
@include('admin.templates.zvn_notify')

<!-- List -->
<div class="card card-info card-outline">
    <div class="card-header">
        <h4 class="card-title">List</h4>
        <div class="card-tools">
            <a href="{{ $linkGroup }}" class="btn btn-tool"><i class="fas fa-sync"></i></a>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <!-- Control -->

        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
            <div class="mb-1">
                <select id="bulk-action" name="bulk-action" class="custom-select custom-select-sm mr-1"
                    style="width: unset">
                    <option value="" selected="">Bulk Action</option>
                    <option value="multi-delete">Multi Delete</option>
                    <option value="multi-active">Multi Active</option>
                    <option value="multi-inactive">Multi Inactive</option>
                </select>
                <button id="bulk-apply" class="btn btn-sm btn-info">Apply
                    <span class="badge badge-pill badge-danger navbar-badge" style="display: none"></span>
                </button>
            </div>
            <a href="{{route($controllerName.'/form') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Add New</a>
        </div>
        <!-- List Content -->
        <form action="" method="post" class="table-responsive" id="form-table">
            <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check-all">
                                <label for="check-all" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="text-center">ID</a></th>
                        <th class="text-center">Name</a></th>
                        <th class="text-center">Status</a></th>
                        <th class="text-center">Group ACP</a></th>
                        <th class="text-center">Created</a></th>
                        <th class="text-center">Modified</a></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($items) > 0)
                        @foreach ($items as $key => $item)

                            @php
                                $checkbox     = Template::checkbox();
                                $id           = Highlight::show($item['id'], $params['search'], 'id');
                                $name         = Highlight::show($item['name'], $params['search'], 'name');
                                $group_acp    = Template::showItemsIcon($controllerName, $id, $item['group_acp'], 'group_acp');
                                $showCreated  = Template::showItemsHistory($item['created_by'], $item['created']);
                                $showModified = Template::showItemsHistory($item['modified_by'], $item['modified']);
                                $status       = Template::showItemsIcon($controllerName, $id, $item['status'], 'status');
                                $showButton   = Template::showButtonsAction($controllerName, $id);

                            @endphp

                            <tr>
                                <td class="text-center">{!! $checkbox !!}</td>
                                <td class="text-center">{!! $id !!}</td>
                                <td class="text-center">{!! $name !!}</td>
                                <td class="text-center position-relative"> {!! $status !!} </td>
                                <td class="text-center position-relative"> {!! $group_acp !!} </td>
                                <td class="text-center">{!! $showCreated !!}</td>
                                <td class="text-center modified-3">{!! $showModified !!}</td>
                                <td class="text-center">{!! $showButton !!}</td>
                            </tr>

                        @endforeach
                    @else
                        @include('admin.templates.list_empty', ['colspan'=>8])
                    @endif

                </tbody>
            </table>
            <div>
                <input type="hidden" name="sort_field" value="">
                <input type="hidden" name="sort_order" value="">
            </div>
        </form>
    </div>

    @if (count($items) > 0)
        <div class="card-footer clearfix">
            @include('admin.templates.pagination')
        </div>
    @endif

</div>
