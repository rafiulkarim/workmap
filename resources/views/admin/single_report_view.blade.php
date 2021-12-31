@extends("layouts.adminlayout. frontlayout")

@section('header_script')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" >
                <div class="card-header">
                    <h4 class="card-title">Single Report View</h4>
                </div>
                <div class="card-body text-dark">
                    <div>
                        <b>Client Name</b><br>
                        {{ $report->reported_client->name }}
                    </div>
                    <br>
                    <div>
                        <b>Freelancer Name</b><br>
                        {{ $report->reported_freelancer->name }}
                    </div>
                    <br>
                    <div>
                        <b>Gig Title</b><br>
                        <a class="text-danger" target="_blank" href="{{ route('single_gig_view', $report->gig_id) }}">
                            {{ $report->reported_gig->title }}
                        </a>
                    </div>
                    <br>
                    <div>
                        <b>Report Text</b><br>
                        {{ $report->message }}
                    </div>
                    <div class="text-right ">
                        <a class="text-dark" href="{{ route('report_list') }}">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
@endsection
