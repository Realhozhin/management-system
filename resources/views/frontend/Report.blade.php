@extends('dashboard.producer.dashboard')

@section('title','build something amazing')
@section('content')
        @if(session('success'))
            <h3 class="text-center text-success">{{session('success')}}</h3>
        @endif
        @if(session('fail'))
            <h3 class="text-center text-danger">{{session('fail')}}</h3>
        @endif
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="p-4 shadow bg-white">
                        <h1>PARNAS</h1>
                        <br/>
                        <h4>have a problem ?</h4>
                        <h5>*report it so we can handle it*</h5>
                        <hr>
                        {!! Form::open(['route'=>'savereport','method'=>'post']) !!}
                            <section class="d-block mt-3">
                                {!! Form::label('name','NAME') !!}
                                {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
                                @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </section>
                            <section class="d-block mt-3">
                                {!! Form::label('email','EMAIL') !!}
                                {!! Form::text('email',old('email'),['class'=>'form-control']) !!}
                                @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </section>
                            <section class="d-block mt-3">
                                {!! Form::label('description','DESCRIPTION') !!}
                                {!! Form::textarea('description',old('description'),['class'=>'form-control','style'=>'resize:none;height:150px']) !!}
                            </section>
                            @error('description')
                                <p class="text-danger">{{$message}}</p>
                            @enderror

                            <section class="d-block mt-5">
                                {!! Form::submit('register',['class'=>'btn btn-success']) !!}
                            </section>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
