@extends('layouts.app')

@section('header_styles')
    <link rel="stylesheet" id="css-main" href="public/assets/css/oneui.css">

<style>


</style>
@stop

@section('content')
    <!-- Start Page Header-->
    <div class="page-header">
        <h1 class="title">Dashboard</h1>
        <ol class="breadcrumb">
            {{--<li class="active">This is a quick overview of some features</li>--}}
        </ol>
        <div class="right" style="top:30px;">
            <a href="{{route('tickets.create')}}" class="btn btn-default"><i class="fa fa-plus"></i>Create</a>
        </div>

    </div>
    @include('layouts.flash')

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="">
            <div class="row">
                <div class="col-sm-5 col-lg-3">
                    <!-- Collapsible Tickets Navigation (using Bootstrap collapse functionality) -->
                    <button class="btn btn-block btn-primary visible-xs push" data-toggle="collapse" data-target="#tickets-nav" type="button">Navigation</button>
                    <div class="collapse navbar-collapse remove-padding" id="tickets-nav">
                        <!-- Tickets Menu -->
                        <div class="block">
                            <div class="block-header bg-gray-lighter">
                                <h3 class="block-title">Tickets</h3>
                            </div>
                            <div class="block-content">
                                <ul class="nav nav-pills nav-stacked push">

                                    <li class="active">
                                        <a href="javascript:void(0)">
                                            <span class="badge pull-right">{{$urgent}}</span><i class="fa fa-fw fa-warning push-5-r"></i> Urgent
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <span class="badge pull-right">{{$open}}</span><i class="fa fa-fw fa-folder-open-o push-5-r"></i> Open
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <span class="badge pull-right">{{$closed}}</span><i class="fa fa-fw fa-folder-o push-5-r"></i> Closed
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Tickets Menu -->

                        <!-- Quick Stats -->
                        <div class="block">
                            <div class="block-header bg-gray-lighter">
                                <h3 class="block-title">Quick Stats</h3>
                            </div>
                            <div class="block-content">
                                <table class="table table-borderless table-condensed table-vcenter font-s13">
                                    <tbody>
                                    <tr>
                                        <td class="font-w600" style="width: 75%;">Tickets</td>
                                        <td class="text-right">{{$total}}</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td class="font-w600">Responses</td>
                                        <td class="text-right">{{$comments}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Quick Stats -->
                    </div>
                    <!-- END Collapsible Tickets Navigation -->
                </div>


                <div class="col-sm-7 col-lg-9">
                    <!-- Tickets List -->
                    <div class="block">
                        <div class="block-content">
                            <!-- Tickets Table -->
                            <div class="pull-r-l">
                                <table class="table table-hover table-vcenter">
                                    <tbody>
                                    @forelse($tickets as $ticket)
                                    <tr>
                                        <td class="font-w600 text-center" style="width: 80px;">#{{$ticket->id}}</td>
                                        <td class="hidden-xs hidden-sm hidden-md text-center" style="width: 100px;">
                                            @if ($ticket->status === 'open')
                                                <span class="label label-success">Open</span>
                                            @else
                                                <span class="label label-danger">Closed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="font-w600" href="{{route('tickets.show' ,$ticket->id)}}" title="Click to Show the Ticket">{{$ticket->subject}}</a>
                                            <div class="text-muted">
                                                <em>{{$ticket->updated_at->diffForHumans()}}</em> by <a href="javascript:void(0)">{{Auth::user()->name}}</a>
                                            </div>
                                        </td>
                                        <td class="hidden-xs hidden-sm hidden-md text-muted" style="width: 120px;">

                                            @if ($ticket->priority === 'high')
                                            <em>Urgent</em>
                                            @elseif ($ticket->priority === 'medium')
                                                <em>{{ $ticket->priority }}</em>
                                            @else
                                                <em>{{ $ticket->priority }}</em>
                                            @endif

                                        </td>
                                        <td class="hidden-xs hidden-sm hidden-md text-center" style="width: 60px;">
                                            <span class="badge badge-primary"><i class="fa fa-comments-o"></i> {{isset($ticket->comments) ? $ticket->comments->count() : 0}}</span>
                                        </td>
                                    </tr>
                                    @empty

                                        <div class="block-content block-content-full block-content-mini">
                                            <i class="fa fa-fw fa-check"></i> <span class="font-w600">No Ticket Found for {{Auth::user()->name}}</span>
                                        </div>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- END Tickets Table -->
                        </div>
                    </div>
                    <!-- END Tickets List -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- Start Footer -->
    <div class="row footer">

    </div>
    <!-- End Footer -->



@stop

@section('footer_scripts')
@stop
