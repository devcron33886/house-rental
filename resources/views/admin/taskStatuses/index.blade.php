@extends('layouts.admin')
@section('content')
@can('task_status_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.task-statuses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.taskStatus.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taskStatus.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover" id="listing">
                <thead>
                    <tr>
                    
                        <th>
                            {{ trans('cruds.taskStatus.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.taskStatus.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskStatuses as $key => $taskStatus)
                        <tr>
                            <td>
                                {{ $taskStatus->id ?? '' }}
                            </td>
                            <td>
                                {{ $taskStatus->name ?? '' }}
                            </td>
                            <td>
                                @can('task_status_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.task-statuses.show', $taskStatus->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('task_status_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.task-statuses.edit', $taskStatus->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('task_status_delete')
                                    <form action="{{ route('admin.task-statuses.destroy', $taskStatus->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
