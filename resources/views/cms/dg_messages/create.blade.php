@extends('cms.application')
@section('content')

    <div class="content-panel">
        <div class="title">
            Commissioner's Desk
        </div>
    </div>

    <div class="row collapse">

        <div class="large-12 columns medium-12 small-12 columns">
            <div class="content-panel">
                <div class="title">
                    Create
                </div>

                <div class="content">
                    <div class="row">
                        <div class="large-8 columns">
                            {!! Form::open(['route' => 'cms.dg_messages.index', 'files' => true]) !!}

                            @include('cms.dg_messages._form', ['submitButton' => "Save"])

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
