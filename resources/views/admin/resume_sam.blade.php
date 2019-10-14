@extends('layouts.app')

@section('judul')
Resume sam
@endsection

@section('title')
Resume sam
@endsection

@section('breadcrumb')
@parent
<li>Resume sam</li>
@endsection

@section('content')     
<div class="container">		  
    <div class="row">
        <div class="col-xs-11">
            <table class="table table-bordered">
                <thead>
                    <th>Periode</th>                    
                    <th>Nama Pol</th>
                    <th>Kode Pol</th>
                    <th>Nama Sam</th>
                    <th>Isi</th>
                </thead>
                <tbody>
                    @foreach ($cari as $item)
                    <tr>
                        <td>{{ $item->nama_periode }}</td>                        
                        <td>{{ $item->namapol }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->isi }}</td>
                    </tr>    
                    @endforeach                                
                </tbody>
            </table>
        </div>        
    </div>      
</div>


@endsection
