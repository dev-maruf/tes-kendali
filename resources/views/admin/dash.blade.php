@extends('layouts.apps')

@section('css')
<!-- JQuery DataTable Css -->
<link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>DEVICE</h2> -->
            </div>  
        </div>
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Mahasiswa
                            </h2>
                            <ul class="header-dropdown m-r--5">                            
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="deviceTable">
                                    <thead>
                                        <tr>
                                            <th>NIU</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NIU</th>
                                            <th>Nama</th>                                                       
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach(\App\User::where('is_admin', '0')->get() as $data)
                                        <tr>
                                            <td>{{$data['username']}}</td>
                                            <td>{{$data['name']}}</td>
                                            <td>@if($data->isOnline())
                                            Login
                                            @else
                                            Tidak
                                            @endif
                                            </td>
                                            <td>
                                                @if($data['active'] == '1')
                                                <form method="POST" action="{{route('set-student')}}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" id="state" name="state" value="0">
                                                    <input type="hidden" id="userid" name="userid" value="{{$data['id']}}">
                                                    <button type="submit" class="btn btn-danger waves-effect">Block</button>
                                                </form>
                                                @else
                                                <form method="POST" action="{{route('set-student')}}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" id="state" name="state" value="1">
                                                    <input type="hidden" id="userid" name="userid" value="{{$data['id']}}">
                                                    <button type="submit" class="btn btn-success waves-effect">Unblock</button>
                                                </form>
                                                @endif
                                                <form method="POST" action="{{route('reset-password')}}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" id="state" name="state" value="1">
                                                    <input type="hidden" id="userid" name="userid" value="{{$data['id']}}">
                                                    <button type="submit" class="btn btn-danger waves-effect">Reset PW</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
@endsection

@section('js')
<!-- Jquery DataTable Plugin Js -->
<script src="/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="/js/pages/tables/jquery-datatable.js"></script>
@endsection