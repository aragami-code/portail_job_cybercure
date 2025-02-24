@extends('backend.layouts.masterL')


@section('title')

TABLEAU DE BORD
@endsection


@section('admin-content')


<div class="dashboard-section user-statistic-block">
    <div class="user-statistic">
      <i data-feather="command"></i>
      <h3>06</h3>
      <span>Total Job Posted</span>
    </div>
    <div class="user-statistic">
      <i data-feather="file-text"></i>
      <h3>123</h3>
      <span>Application Submit</span>
    </div>
    <div class="user-statistic">
      <i data-feather="users"></i>
      <h3>32</h3>
      <span>Call for interview</span>
    </div>
  </div>
  <div class="dashboard-section dashboard-view-chart">
    <canvas id="view-chart" width="400" height="200"></canvas>
  </div>

</div>





@endsection
