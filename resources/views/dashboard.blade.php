@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-warning">
                  <div class="inner">
                      <h3>{{ $userCount }}</h3>
                      <p>Total Users</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-person"></i>
                  </div>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>{{ $passPercentage }}%</h3>
                  <p>Passing Percentage</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $evaluatedCount }} / {{ $userCount }}</h3>
                  <p>Total Evaluated</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card bg-gradient-success">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                        <i class="far fa-calendar-alt"></i>
                        Calendar
                        </h3>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Recent Evaluations</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-striped">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Points</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach ($recentEvaluations as $evaluation)
                            <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $evaluation->user-name }}</td>
                              <td>{{ $evaluation->total_score }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
</section>
@endsection
@section('footer-script')
<!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/Dashboard.js') }}"></script>
@endsection