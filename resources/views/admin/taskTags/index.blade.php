@extends('layouts.admin')
@section('content')
@can('task_tag_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.task-tags.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.taskTag.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taskTag.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover" id="listing"
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taskTag.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.taskTag.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskTags as $key => $taskTag)
                        <tr data-entry-id="{{ $taskTag->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taskTag->id ?? '' }}
                            </td>
                            <td>
                                {{ $taskTag->name ?? '' }}
                            </td>
                            <td>
                                @can('task_tag_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.task-tags.show', $taskTag->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('task_tag_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.task-tags.edit', $taskTag->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('task_tag_delete')
                                    <form action="{{ route('admin.task-tags.destroy', $taskTag->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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