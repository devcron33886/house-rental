@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.infrastructure.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.infrastructures.update", [$infrastructure->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="houses">{{ trans('cruds.infrastructure.fields.house') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('houses') ? 'is-invalid' : '' }}" name="houses[]" id="houses" multiple required>
                    @foreach($houses as $id => $house)
                        <option value="{{ $id }}" {{ (in_array($id, old('houses', [])) || $infrastructure->houses->contains($id)) ? 'selected' : '' }}>{{ $house }}</option>
                    @endforeach
                </select>
                @if($errors->has('houses'))
                    <span class="text-danger">{{ $errors->first('houses') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.infrastructure.fields.house_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.infrastructure.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $infrastructure->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.infrastructure.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.infrastructure.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.infrastructure.fields.photos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.infrastructure.fields.address') }}</label>
                <input class="form-control map-input {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $infrastructure->address) }}">
                <input type="hidden" name="latitude" id="address-latitude" value="{{ old('latitude', $infrastructure->latitude) ?? '0' }}" />
                <input type="hidden" name="longitude" id="address-longitude" value="{{ old('longitude', $infrastructure->longitude) ?? '0' }}" />
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.infrastructure.fields.address_helper') }}</span>
            </div>
            <div id="address-map-container" class="mb-2" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
            <label>{{ trans('cruds.infrastructure.fields.working_hours') }}</label>
            @foreach($days as $day)
                <div class="form-inline">
                    <label class="my-1 mr-2">{{ ucfirst($day->name) }}: from</label>
                    <select class="custom-select my-1 mr-sm-2" name="from_hours[{{ $day->id }}]">
                        <option value="">--</option>
                        @foreach(range(0,23) as $hours)
                            <option
                                value="{{ $hours < 10 ? "0$hours" : $hours }}"
                                {{ old('from_hours.'.$day->id, $infrastructure->days->find($day->id) ? $infrastructure->days->find($day->id)->pivot['from_hours'] : null) == ($hours < 10 ? "0$hours" : $hours) ? 'selected' : '' }}
                            >{{ $hours < 10 ? "0$hours" : $hours }}</option>
                        @endforeach
                    </select>
                    <label class="my-1 mr-2">:</label>
                    <select class="custom-select my-1 mr-sm-2" name="from_minutes[{{ $day->id }}]">
                        <option value="">--</option>
                        <option value="00" {{ old('from_minutes.'.$day->id, $infrastructure->days->find($day->id) ? $infrastructure->days->find($day->id)->pivot['from_minutes'] : null) == '00' ? 'selected' : '' }}>00</option>
                        <option value="30" {{ old('from_minutes.'.$day->id, $infrastructure->days->find($day->id) ? $infrastructure->days->find($day->id)->pivot['from_minutes'] : null) == '30' ? 'selected' : '' }}>30</option>
                    </select>
                    <label class="my-1 mr-2">to</label>
                    <select class="custom-select my-1 mr-sm-2" name="to_hours[{{ $day->id }}]">
                        <option value="">--</option>
                        @foreach(range(0,23) as $hours)
                            <option
                                value="{{ $hours < 10 ? "0$hours" : $hours }}"
                                {{ old('to_hours.'.$day->id, $infrastructure->days->find($day->id) ? $infrastructure->days->find($day->id)->pivot['to_hours'] : null) == ($hours < 10 ? "0$hours" : $hours) ? 'selected' : '' }}
                            >{{ $hours < 10 ? "0$hours" : $hours }}</option>
                        @endforeach
                    </select>
                    <label class="my-1 mr-2">:</label>
                    <select class="custom-select my-1 mr-sm-2" name="to_minutes[{{ $day->id }}]">
                        <option value="">--</option>
                        <option value="00" {{ old('to_minutes.'.$day->id, $infrastructure->days->find($day->id) ? $infrastructure->days->find($day->id)->pivot['to_minutes'] : null) == '00' ? 'selected' : '' }}>00</option>
                        <option value="30" {{ old('to_minutes.'.$day->id, $infrastructure->days->find($day->id) ? $infrastructure->days->find($day->id)->pivot['to_minutes'] : null) == '30' ? 'selected' : '' }}>30</option>
                    </select>
                </div>
            @endforeach

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
