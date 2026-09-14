@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('page_header', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Users</h4>
          </div>
          <div class="card-body">
            10
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-box"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Products</h4>
          </div>
          <div class="card-body">
            42
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Orders</h4>
          </div>
          <div class="card-body">
            12
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
