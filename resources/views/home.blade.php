@extends('layouts.app')

@section('external-css')
<link href="{{ asset('css/userdashboard.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@include('layouts.user-dashboard-nav')


@section('content')
<body class="bg-light">

    <main role="main" class="container">
        <div id="page-wrapper" class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                    <h1 class="page-header"></h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="card" style="width: 16rem;">
                        <div class="card-body ">
                            <div>
                                <div style="float:left">
                                   <i class="fa fa-list-ul" style="font-size:40px; color:#2737A6"></i>
                                </div>
                                <div class=" " style="float:right ">
                                    <div class="huge"><h1 style="color:#2737A6"><strong>{{ $totalTickets }}</strong></h1></div>
                                    <div>Total Tickets</div>
                                </div>
                            </div>
                            <div style="clear:both "> <a href="#" class="btn btn-outline-primary btn-sm">View details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card" style="width: 16rem; ">
                        <div class="card-body ">
                            <div>
                                <div style="float:left ">
                                    <i class="fa fa-envelope-open-o" style="font-size:40px; color:#2737A6"></i>
                                </div>
                                <div class=" " style="float:right">
                                    <div class="huge"><h1 style="color:#2737A6"><strong>{{ $totalTicketsOpen }}</strong></h1></div>
                                    <div>Open Tickets</div>
                                </div>
                            </div>
                            <div style="clear:both "> <a href="# " class="btn btn-outline-primary btn-sm ">View details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card " style="width: 16rem; ">
                        <div class="card-body ">
                            <div>
                                <div style="float:left ">
                                   <i class="fa fa-close" style="font-size:40px; color:#2737A6"></i>
                                </div>
                                <div class=" " style="float:right ">
                                    <div class="huge"><h1 style="color:#2737A6"><strong>{{ $totalTicketsClosed }}</strong></h1></div>
                                    <div>Closed Tickets</div>
                                </div>
                            </div>
                            <div style="clear:both "> <a href="# " class="btn btn-outline-primary btn-sm">View details</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->is_admin)
                    <div class="col-sm-3 ">
                        <div class="card " style="width: 16rem; ">
                            <div class="card-body ">
                                <div>
                                    <div style="float:left ">
                                    <i class="fa fa-group" style="font-size:40px; color:#2737A6"></i>
                                    </div>
                                    <div class=" " style="float:right ">
                                        <div class="huge"><h1 style="color:#2737A6"><strong>{{ $totalAdmins }}</strong></h1></div>
                                        <div>Total Admins</div>
                                    </div>
                                </div>
                                <div style="clear:both "> <a href="# " class="btn btn-outline-primary btn-sm">View details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-sm-3">
                            <div class="card " style="width: 16rem; ">
                                <div class="card-body ">
                                    <div>
                                        <div style="float:left ">
                                        <i class="fa fa-comments-o" style="font-size:40px; color:#2737A6"></i>
                                        </div>
                                        <div class=" " style="float:right ">
                                            <div class="huge"><h1 style="color:#2737A6"><strong>{{ $totalComments}}</strong></h1></div>
                                            <div>Total Comments</div>
                                        </div>
                                    </div>
                                    <div style="clear:both "> <a href="# " class="btn btn-outline-primary btn-sm">View details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            </div>

            <br><br>
            @if ($tickets->isEmpty())
                <p>You have not created any tickets.</p>
            @else
                <table class="table">
                    <thead style="background:#2737A6;color:white">
                        <tr>

                            <th>Ticket ID</th>
                            <th> Title</th>
                            <th> Category</th>
                            <th> Status</th>
                            <th> Last Updated</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td >
                                    <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                                        {{ $ticket->ticket_id }}
                                    </a>
                                </td>
                                <td>
                                    {{ $ticket->title }}
                                </td>
                                <td>
                                @foreach ($categories as $category)
                                    @if ($category->id === $ticket->category_id)
                                        {{ $category->name }}
                                    @endif
                                @endforeach
                                </td>
                                <td>
                                @if ($ticket->status === 'Open')
                                    <span class="label label-success text-success">{{ $ticket->status }}</span>
                                @else
                                    <span class="label label-danger text-danger">{{ $ticket->status }}</span>
                                @endif
                                </td>
                                <td>{{ $ticket->updated_at }}</td>
                                <td>  
                                    <form action="{{ url('tickets/'. $ticket->ticket_id) }}" method="GET">
                                         <button type="submit" class="btn btn-primary btn-sm">Comment</button>  
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $tickets->render() }}

            @endif
  
        </div>
    </main>

@endsection