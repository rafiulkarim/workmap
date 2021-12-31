@extends("layouts.adminlayout. frontlayout")

@section('header_script')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" >
                <div class="card-header">
                    <h4 class="card-title">Gig Report List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table header-border " style="color: #000000">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Freelancer Name</th>
                                <th scope="col">Freelancer Email</th>
                                <th scope="col">Gig Title</th>
                                <th scope="col">Report message</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                                @foreach($reports as $report)
                                    <tr>
                                        <th> {{ $i++ }}</th>
                                        <td>{{ $report->reported_client->name }}</td>
                                        <td>{{ $report->reported_freelancer->name }}</td>
                                        <td>{{ $report->reported_freelancer->email }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($report->reported_gig->title, 20, $end='...') }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($report->message, 20, $end='...') }}</td>
                                        <td><a href="{{ route('report_view', $report->id) }}" class="btn btn-outline-primary btn-sm">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
@endsection
