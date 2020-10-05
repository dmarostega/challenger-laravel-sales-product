@extends('_layouts.template')

@section('subtitle','Loggers')

@section('content')  
    <div class="row">
        <div class="col-6 mt-5">
            <h1>@yield('subtitle')</h1>
        </div>   
    </div>
    @if(    session('success')  )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{ session('success') }}
        </div>
    @endif
    @if(    session('fail')  )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{ session('fail') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 table-responsive-sm">
            <div class="card">
                <div class="card-header">
                   <strong> {{ $user->name }} </strong> Log´s
                </div>
                <div class="card-body">
                    @foreach ($logs as $log)
                        <p>
                            {{ $log->message }} em {{ date('d/m/Y H:i:s',strtotime($log->created_at)) }}   
                        </p>  
                    @endforeach
                                    
                </div>
                <div class="card-footer">
                    <small>Today: {{ date('d/m/Y H:i:s') }}</small>
                </div>
            </div>
            <div class="row m-3">
                <div class="col-12 ">
                    <a class="btn btn-secondary btn-sm float-right" href="{{ route('init') }}">
                        Init
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection