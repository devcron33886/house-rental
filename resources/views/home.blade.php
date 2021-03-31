@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($settings1['total_number']) }}</h3>

                        <p>{{ $settings1['chart_title'] }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($settings2['total_number']) }}</h3>

                        <p>{{ $settings2['chart_title'] }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ number_format($settings3['total_number']) }}</h3>

                        <p>{{ $settings3['chart_title'] }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('admin.subscribers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ number_format($settings4['total_number']) }}</h3>

                        <p>{{ $settings4['chart_title'] }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('admin.houses.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <section class="col-lg-6 connectedSortable ui-sortable">
                <div class="card">
                    <div class="card-header"><h3>{!! $chart5->options['chart_title'] !!}</h3></div>
                    <div class="card-body">
                        {!! $chart5->renderHtml() !!}
                    </div>
                </div>
                <div class="card bg-gradient-info">
                    <div class="card-header"><h3>{!! $chart7->options['chart_title'] !!}</h3></div>
                    <div class="card-body">
                        {!! $chart7->renderHtml() !!}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h3>{{ $settings9['chart_title'] }}</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                @foreach($settings9['fields'] as $key => $value)
                                    <th>
                                        {{ trans(sprintf('cruds.%s.fields.%s', strtolower(last(explode('\\', $settings9['model']))), $key)) }}
                                    </th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($settings9['data'] as $entry)
                                <tr>
                                    @foreach($settings9['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                                {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                                @foreach($entry->{$key} as $subEentry)
                                                    <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                @endforeach
                                            @else
                                                {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($settings9['fields']) }}">{{ __('No entries found') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable ui-sortable">
                <div class="card">
                    <div class="card-header"><h3>{!! $chart6->options['chart_title'] !!}</h3></div>
                    <div class="card-body">
                        {!! $chart6->renderHtml() !!}
                    </div>

                </div>
                <div class="card">
                    <div class="card-header"><h3>{!! $chart10->options['chart_title'] !!}</h3></div>
                    <div class="card-body">
                        {!! $chart10->renderHtml() !!}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h3>{!! $chart11->options['chart_title'] !!}</h3></div>
                    <div class="card-body">
                        {!! $chart11->renderHtml() !!}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h3>{{ $settings8['chart_title'] }}</h3></div>
                    <div class="card-body">


                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                @foreach($settings8['fields'] as $key => $value)
                                    <th>
                                        {{ trans(sprintf('cruds.%s.fields.%s', strtolower(last(explode('\\', $settings8['model']))), $key)) }}
                                    </th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($settings8['data'] as $entry)
                                <tr>
                                    @foreach($settings8['fields'] as $key => $value)
                                        <td>
                                            @if($value === '')
                                                {{ $entry->{$key} }}
                                            @elseif(is_iterable($entry->{$key}))
                                                @foreach($entry->{$key} as $subEentry)
                                                    <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                @endforeach
                                            @else
                                                {{ data_get($entry, $key . '.' . $value) }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($settings8['fields']) }}">{{ __('No entries found') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    {!! $chart5->renderJs() !!}
    {!! $chart6->renderJs() !!}
    {!! $chart7->renderJs() !!}
    {!! $chart10->renderJs() !!}
    {!! $chart11->renderJs() !!}
@endsection
