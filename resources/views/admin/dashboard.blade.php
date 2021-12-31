<?php
    $totalOrder = \App\Http\Controllers\HelperController::total_order();
    $completeOrder = \App\Http\Controllers\HelperController::complete_order();
    $pendingOrder = \App\Http\Controllers\HelperController::pending_order();
    $todayOrder = \App\Http\Controllers\HelperController::today_order();
    $totalUser = \App\Http\Controllers\HelperController::total_user();
    $freelancer = \App\Http\Controllers\HelperController::freelancer();
    $client = \App\Http\Controllers\HelperController::client();
    $reviewed = \App\Http\Controllers\HelperController::reviewed();
?>

@extends('layouts.adminlayout. frontlayout')

@section('header_script')
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Order</div>
                        <div class="stat-digit"> {{ $totalOrder }}</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary w-100" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Completed Order</div>
                        <div class="stat-digit"> {{ $completeOrder }}</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: {{ $completeOrder == 0 ? 0 : round(($completeOrder/$totalOrder)*100) }}%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Pending Order</div>
                        <div class="stat-digit">{{ $pendingOrder }}</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger" style="width: {{ $pendingOrder == 0 ? 0 : round(($pendingOrder/$totalOrder)*100) }}%" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Today Order</div>
                        <div class="stat-digit"> {{ $todayOrder }}</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning w-100" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
        <!-- /# column -->
    </div>
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Users</div>
                        <div class="stat-digit"> {{ $totalUser }}</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-info w-100" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Freelancer</div>
                        <div class="stat-digit"> {{ $freelancer }}</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $freelancer == 0 ? 0 : round(($freelancer/$totalUser)*100) }}%; background: #00cc66!important;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Client</div>
                        <div class="stat-digit">{{ $client }}</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $client == 0 ? 0 : round(($client/$totalUser)*100) }}%; background: #0b0b0b!important;" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
        </div>
        <!-- /# column -->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Gig Reviews</h4>
                </div>
                <div class="card-body">
                    <div class="current-progress">
                        <div class="progress-content py-2">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="progress-text text-dark">Reviewed</div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="current-progressbar">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" style="width: {{ $reviewed == 0 ? 0 : round(($reviewed/$totalOrder)*100) }}%" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                {{ $reviewed == 0 ? 0 : round(($reviewed/$totalOrder)*100) }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>

    </div>
@endsection

@section('footer_script')

@endsection



