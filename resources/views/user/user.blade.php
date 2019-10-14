@extends('layouts.app')

@section('judul')
  Preperso Ektp 2018
@endsection

@section('title')
  Preperso
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">halaman Utama</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <center>You are logged in! User</center>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection