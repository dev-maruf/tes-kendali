@extends('layouts.apps')

@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Profile</h2>
            </div>                                    

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Ubah Password
                            </h2>                            
                        </div>
                        <div class="body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                <strong>Selamat!</strong> Perubahan password sudah berhasil dilakukan
                            </div>
                        @endif                            
                        @if (session('not-same'))
                            <div class="alert alert-danger">
                                Kata sandi yang anda masukkan tidak sama :(
                            </div>
                        @endif                            
                            <form method="POST" action="{{route('change-pass')}}">
                                {{csrf_field()}}                                
                                <label for="password">Password Baru</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                                    </div>
                                </div>

                                <label for="confirm_password">Ulangi Password Baru</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Enter your confirm password" required>
                                    </div>
                                </div>                                
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Ubah Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                                            
        </div>
    </section>
@endsection
