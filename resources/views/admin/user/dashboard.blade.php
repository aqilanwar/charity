@extends('admin.index')
@section('title' , 'Dashboard')

@section('content')
    @if(Auth::user()->role_id == 2)
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>

            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Donation </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">RM {{number_format(floor($totaldonation*100)/100, 2)}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Registered User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totaluser}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Upcoming event
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$upcoming}}</div>
                                        </div>
               
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Total launched event</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$launched}} </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Content Row -->
            <div class="card shadow mb-4">
                <div class="card-header pl-0 pr-0">
                    <div class="row no-gutters w-100 align-items-center">
                        <div class="col ml-3">List of latest donation</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Donator Name</th>
                                    <th>Email Address</th>
                                    <th>Amount (RM)</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            @php
                                $i = 1;   
                            @endphp
                                @foreach ($donator as $donate)
                                        <tbody>
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td> {{$donate->name}} </td>
                                                <td> {{$donate->email}} </td>
                                                <td class="text-start">RM {{ number_format(floor($donate->amount*100)/100, 2)}} </td>
                                                <td> {{$donate->created_at}} </td>
                                            </tr>
                                        </tbody>
                                @endforeach
                        </table>
                    </div>
                </div>   
            </div>

        </div>
        <!-- /.container-fluid -->
    @else
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>    
            <div class="card shadow mb-4">
                <h5 class="card-header d-flex justify-content-between align-items-center">
                    List of event that you partcipate in     
                </h5>
                @if($joined->isEmpty())
                    <div class="card-body">
                        You haven't participate in any event. <a href="../event" >Be a participant now ! </a>
                    </div>
                @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Event Title</th>
                                    <th>Event Place</th>
                                    <th>Event Date</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @php
                                    $i = 1; 
                                @endphp             
                                @foreach($joined as $join) 
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a href="../event/{{$join->id}}" > {{$join->event_title}}</a></td>
                                    <td>{{$join->event_place}}</td>
                                    <td>{{ Carbon\Carbon::parse($join->event_date)->format('d M Y') }}
                                    </td>
                                </tr>
    
                                @endforeach
    
                            </tbody>
                        </table>
                    </div>
                </div> 
                @endif
            </div>
    </div>  
    @endif


@endsection