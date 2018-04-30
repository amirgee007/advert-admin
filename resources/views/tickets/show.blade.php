@extends('layouts.app')

@section('header_styles')
    <link rel="stylesheet" id="css-main" href="{{asset('public/assets/css/oneui.css')}}">

@stop

@section('content')
    <!-- Start Page Header-->
    <div class="page-header">
        <h1 class="title">Show Ticket</h1>
        <ol class="breadcrumb">
            {{--<li class="active">This is a quick overview of some features</li>--}}
        </ol>
        <div class="right" style="top:30px;">
            <a href="{{route('tickets.create')}}" class="btn btn-default"><i class="fa fa-plus"></i>Create</a>
        </div>
    </div>

    @include('layouts.flash')
    <div class="container-widget">
        <div class="col-md-12">
            <br>
            <ul class="topstats clearfix">
                <li class="col-md-12">

                    <div class="row">

                        <div class="col-md-10 col-md-offset-1">
                            <div class="panel panel-default">


                                <div class="block block-themed block-transparent remove-margin-b">
                                    <div class="block-header bg-primary-dark">
                                        <ul class="block-options">
                                            <li>
                                                <span class="label label-success">{{$ticket->status}}</span>
                                            </li>
                                        </ul>
                                        <h3 class="block-title">#{{$ticket->id}}</h3>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <ul class="nav-users">
                                                    <li>
                                                        <a href="#">
                                                            <img class="img-avatar" src="{{asset('public/assets/img/avatars/avatar2.jpg')}}" alt="">
                                                            <i class="fa fa-circle text-success"></i> {{Auth::user()->name}}
                                                            <div class="font-w400 text-muted"><small><i class="fa fa-user"></i> Client</small></div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <ul class="nav-users">
                                                    <li>
                                                        <a href="#">
                                                            <img class="img-avatar" src="{{asset('public/assets/img/avatars/avatar2.jpg')}}" alt="">
                                                            <i class="fa fa-circle text-success"></i> <span class="text-amethyst">Not Assign</span>
                                                            <div class="font-w400 text-muted"><small><i class="fa fa-support"></i> Support</small></div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-full block-content-mini bg-gray-light">
                                        <span class="text-muted pull-right"><em>{{ $ticket->created_at->diffForHumans() }}</em></span>
                                        <span class="font-w600">{{$ticket->subject}}</span> by
                                        <a href="javascript:void(0)">{{Auth::user()->name}}</a>
                                    </div>
                                    <div class="block-content">
                                        <p>{{$ticket->content}}</p>
                                        <p>
                                            <code>{{$ticket->subject}}</code>
                                        </p>
                                    </div>

                                    @foreach ($comments as $comment)
                                    <div class="block-content block-content-full block-content-mini @if($ticket->user->id === $comment->user_id) {{"bg-gray-light"}} @else {{"bg-warning-light"}} @endif" >
                                        <span class="text-muted pull-right"><em>{{ $comment->created_at->diffForHumans() }}</em></span>
                                        <span class="font-w600">Re: {{$ticket->subject}}</span> by
                                        <a class="text-amethyst" href="javascript:void(0)">{{$comment->user->name}}</a>
                                    </div>
                                    <div class="block-content">
                                        {!!html_entity_decode($comment->content)!!}

                                    </div>

                                    @endforeach


                                    @if($ticket->status=='open')

                                    <div class="block-content block-content-full block-content-mini bg-gray-light">
                                        <i class="fa fa-fw fa-plus"></i> <span class="font-w600">New Reply</span>
                                    </div>

                                    <div class="block-content">
                                        <form class="form-horizontal" action="{{ route('tickets.comment') }}" method="POST">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                            <div class="form-group push-10 {{ $errors->has('comment') ? ' has-error' : '' }}">
                                                <div class="col-xs-12">
                                                    <textarea class="form-control" id="content" rows="4" name="content" placeholder="Your answer.."></textarea>
                                                </div>

                                                @if ($errors->has('content'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('content') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-sm btn-default" type="submit">
                                                        <i class="fa fa-fw fa-reply text-success"></i> Reply
                                                    </button>
                                                    <button class="btn btn-sm btn-default" type="reset">
                                                        <i class="fa fa-fw fa-repeat text-danger"></i> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        <div class="block-content block-content-full bg-gray-lighter clearfix">
                                            <a href="{{route('tickets.close' ,$ticket->id)}}" onclick="return confirm('are you sure to Mark as Closed the ticket ?')" title="Click to Close the Ticket" class="pull-right btn btn-sm btn-rounded btn-noborder btn-primary" type="button">
                                                <i class="fa fa-fw fa-check"></i> Mark as resolved
                                            </a>
                                            <a href="{{route('tickets.urgent' ,$ticket->id)}}" onclick="return confirm('are you sure to make it urgent ticket ?')" title="Click to Make the Ticket Urgent" class="btn btn-sm btn-rounded btn-noborder btn-warning" type="button" style="float: left">
                                                <i class="fa fa-fw fa-warning"></i> Mark as urgent
                                            </a>
                                        </div>
                                    @else
                                        <div class="block-content block-content-full block-content-mini bg-success-light">
                                            <i class="fa fa-fw fa-check"></i> <span class="font-w600">Ticket Closed Already</span>
                                        </div>
                                    @endif

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
