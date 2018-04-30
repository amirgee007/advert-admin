@extends('layouts.app')

@section('header_styles')

@stop

@section('content')
    <!-- Start Page Header-->
    <div class="page-header">
        <h1 class="title">Create Ticket</h1>
        <ol class="breadcrumb">
            {{--<li class="active">This is a quick overview of some features</li>--}}
        </ol>
        <div class="right" style="top:30px;">
            <a href="{{route('tickets.create')}}" class="btn btn-default"><i class="fa fa-plus"></i>Create</a>
        </div>
    </div>

    <div class="container-widget">
        <div class="col-md-12">
            <br>
            <ul class="topstats clearfix">
                <li class="col-md-12">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading">Create New Ticket</div>

                                <div class="panel-body">
                                    @include('layouts.flash')
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('tickets.save') }}">
                                        {!! csrf_field() !!}

                                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                            <label for="subject" class="col-md-4 control-label">Subject</label>

                                            <div class="col-md-6">
                                                <input id="title" type="text" class="form-control" name="subject"
                                                       value="{{ old('subject') }}">

                                                @if ($errors->has('subject'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                                            <label for="priority" class="col-md-4 control-label">Priority</label>

                                            <div class="col-md-6">
                                                <select id="priority" type="" class="form-control" name="priority">
                                                    <option value="">Select Priority</option>
                                                    <option value="low">Low</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="high">High</option>
                                                </select>

                                                @if ($errors->has('priority'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('priority') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                            <label for="content" class="col-md-4 control-label">Content</label>

                                            <div class="col-md-6">
                                                <textarea rows="10" id="content" class="form-control"
                                                          name="content"></textarea>

                                                @if ($errors->has('content'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('content') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-ticket"></i> Create New Ticket
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- End Top Stats -->

    </div>
    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- Start Footer -->
    <div class="row footer">

    </div>
    <!-- End Footer -->



@stop

@section('footer_scripts')


@stop
