@extends('layouts.app')

@section('content')


    <!-- Start Page Header-->
    <div class="page-header">
        <h1 class="title">Dashboard</h1>
        <ol class="breadcrumb">
            {{--<li class="active">This is a quick overview of some features</li>--}}
        </ol>

        <div class="right" style="top:30px;">
            <a href="#" class="btn btn-default"><i class="fa fa-download"></i>Payout</a>
        </div>

        <!-- Start Page Header Right Div -->
        <div class="right" style="top:20px;right:140px">
            <h4 style="margin-top:0px;margin-bottom:5px; font-size:1.2em">Your balance </h4>
            <h4 style="margin-bottom:0px;margin-top:0px; font-size:1.2em">₽{{$balance *0.6}}</h4>
        </div>



        <!-- End Page Header Right Div -->

    </div>
    <!-- End Page Header -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START CONTAINER -->
    <div class="container-widget">

        <!-- Start Top Stats -->
        <div class="col-md-12">
            <ul class="topstats clearfix">
                <!--<li class="arrow"></li>-->
                <li class="col-xs-6 col-lg-2">
                    <span class="title"><i class="fa fa-dot-circle-o"></i> Today Profit</span>
                    <h3>₽{{$todayProfit['profit'] *0.6}}</h3>
                    <span class="diff"><b class="{{($todayProfit['percent']<0)? 'color-up':'color-down'}}"><i class="fa fa-caret-down"></i> {{($todayProfit['percent']<0)? $todayProfit['percent']*-1:$todayProfit['percent']}}%</b> from yesterday</span>
                </li>
                <li class="col-xs-6 col-lg-2">
                    <span class="title"><i class="fa fa-calendar-o"></i> This Week</span>
                    <h3>₽{{$weekProfit['profit'] }}</h3>
                    <span class="diff"><b class="{{($weekProfit['percent']<0)? 'color-up':'color-down'}}"><i class="fa fa-caret-down"></i> {{($weekProfit['percent']<0)? $weekProfit['percent']*-1:$weekProfit['percent']}}%</b> from last week</span>
                </li>
                <li class="col-xs-6 col-lg-2">
                    <span class="title"><i class="fa fa-shopping-cart"></i> Total Leads</span>
                    <h3 class="color-up">{{$todayLeads['leads']}}</h3>
                    <span class="diff"><b class="{{($todayLeads['percent']<0)? 'color-up':'color-down'}}"><i class="fa fa-caret-down"></i> {{($todayLeads['percent']<0)? $todayLeads['percent']*-1:$todayLeads['percent']}}%</b> from yesterday</span>
                </li>
                <li class="col-xs-6 col-lg-2">
                    <span class="title"><i class="fa fa-users"></i> Visitors</span>
                    <h3>0</h3>
                    <span class="diff"><b class="color-down"><i class="fa fa-caret-down"></i> 0%</b> from yesterday</span>
                </li>
                <li class="col-xs-6 col-lg-2">
                    <span class="title"><i class="fa fa-eye"></i> Page View</span>
                    <h3 class="color-up">0</h3>
                    <span class="diff"><b class="color-down"><i class="fa fa-caret-down"></i> 0%</b> from yesterday</span>
                </li>
                <li class="col-xs-6 col-lg-2">
                    <span class="title"><i class="fa fa-clock-o"></i> Avarage Time</span>
                    <h3 class="color-down">0:00<small>min</small></h3>
                    <span class="diff"><b class="color-down"><i class="fa fa-caret-down"></i> 0%</b> from yesterday</span>
                </li>
            </ul>
        </div>
        <!-- End Top Stats -->


        <!--//////////////////////////////////////////////////////////////////////////////-->
        <!-- Start Chart-->
        <div class="col-md-12">
            <div id="nvd1" style="background-color:white;margin-bottom:20px; padding: 10px">
                <canvas id="line-chart" width="800" height="450"></canvas>
            </div>
        </div>
        <!-- End Chart -->

    </div>
    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- Start Footer -->
    <div class="row footer">

    </div>
    <!-- End Footer -->


    <script>
        var d = new Date();
        var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: [@foreach($statistic as $k=> $item) '{{$k}}', @endforeach],
                datasets: [{
                    data: [@foreach($statistic as  $item) '{{$item['profit']}}', @endforeach],
                    label: "Sales",
                    borderColor: "#f44336",
                    fill: false
                }, {
                    data: [@foreach($statistic as  $item) '{{$item['clicks']}}', @endforeach],
                    label: "Clicks",
                    borderColor: "#8bc34a",
                    fill: false
                }, {
                    data: [@foreach($statistic as  $item) '{{$item['leads']}}', @endforeach],
                    label: "Leads",
                    borderColor: "#ffc107",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Statistic in '+ month[d.getMonth()]
        }
            }
        });


    </script>



@endsection

