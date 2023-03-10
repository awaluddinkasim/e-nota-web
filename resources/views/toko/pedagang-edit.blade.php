@extends('layout')

@section('content')
    <div class="page-heading">
        <h3>Edit Pedagang</h3>
    </div>

    <div class="page-content">
        <section class="section">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/images/edit.svg') }}" alt="" class="w-75">
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Pedagang</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pedagang.update', ['id' => $pedagang->id]) }}" method="POST">
                                @method("PUT")
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama lengkap</label>
                                    <input type="text" id="nama" class="form-control" name="nama" required value="{{ $pedagang->nama }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control" name="username" required value="{{ $pedagang->username }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" name="password">
                                </div>
                                <div class="clearfix">
                                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
