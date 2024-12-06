@extends('layouts.main')

@section('title', 'Profile')
@section('content')

@php
    $rolesUser = [];
    foreach ($user->roles as $item) {
        array_push($rolesUser, $item->kode_role);
    }
@endphp

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <span class="ml-1">Profile</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-warning alert-dismissible alert-alt solid fade show">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
            <li><strong>Warning!</strong> {{$error}}. Silahkan Cek Kembali.</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success alert-dismissible alert-alt solid fade show">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
        <li><strong>Success!</strong> {{session('success')}}. Silahkan Cek Kembali.</li>
    </div>
    @endif

    @if (session('warning'))
    <div class="alert alert-success alert-dismissible alert-alt solid fade show">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
        <li><strong>Warning!</strong> {{session('warning')}}. Silahkan Cek Kembali.</li>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form text-dark">
                        <form actiob="{{route('users.profile', $user->id)}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if (in_array('CST', $rolesUser))
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama"
                                    value="{{$user->konsumen->nama ?? ''}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-cm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat"
                                    value="{{$user->konsumen->alamat ?? ''}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_hp"
                                    value="{{$user->konsumen->no_hp ?? ''}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username"
                                    value="{{$user->username}}" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password"
                                    placeholder="Password">
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <label class="col-form-label col-sm-2 pt-0">Radios</label>
                                    <div class="col-sm-10">

                                        @foreach ($roles as $item)
                                        <div class="form-check-input" type="radio" name="gridRadios"
                                        value="option3"
                                        {{in_array($item->kode_role, $rolesUser) ? 'checked' : ''}}
                                        disabled required>
                                        <label class="form-check-label">
                                            {{$item->nama_role}}
                                        </label>
                                    </div>
                                        @endforeach
                                    </div>
                                </div>
                            </fieldset>
                            {{-- <div class="form-group row">
                                <div class="col-sm-2">Checkbox</div>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">
                                            Example checkbox
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                            @elseif (in_array('ADM', $rolesUser))
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Rental</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_rental"
                                    value="{{$user->rentalMobil->nama_rental ?? ''}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10">{{$user->rentalMobil->deskripsi ?? ''}}</textarea>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="alamat"
                                        value="{{$user->rentalMobil->alamat ?? ''}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">No Hp</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_hp"
                                        value="{{$user->rentalMobil->no_hp ?? ''}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Foto</label>
                                        <div class="com-sm-10">
                                            <input type="file" class="form-control" name="foto"
                                            value="{{$user->rentalMobil->foto ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="username"
                                            value="{{$user->username}}" placeholder="Username" required>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password"
                                                placeholder="Password">
                                            </div>>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <label class="col-sm-10">

                                                    @foreach ($roles as $item)
                                                    <div class="form-check disabled">
                                                        <input class="form-check-input" type="radio" name="gridRadios"
                                                        value="option3"
                                                        {{in_array($item->kode_role< $rolesUser) ?? 'checked': ''}}
                                                        disabled required>
                                                        <label class="form-check-label">
                                                            {{$item->nama_role}}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                        </fieldset>
                                        @elseif (in_array('SAD', $rolesUser))
                                        <div class="form-group row">
                                            <label class="col-sm-2-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="username"
                                                value="{{$user->username}}" placeholder="Username" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2-form-label"> Password</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="password"
                                                    value="{{$user->username}}" placeholder="Username" required>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password"
                                                        placeholder="Password">
                                                    </div>
                                                </div>
                                                <fieldset class="form-group">
                                                    <div class="row">
                                                        <label class="col-form-label col-sm-2 pt-0">Radios</label>
                                                        <div class="col-sm-10">
                                                            @foreach ($roles as $item)
                                                            <div class="form-check disabled">
                                                                <input class="form-check-input" type="radio" name="gridRadios"
                                                                value="option3"
                                                                {{in_array($item->kode_role, $rolesUser) ? 'checked' : ''}}
                                                                disabled required>
                                                                <label class="form-check-label">
                                                                    {{$item->nama_role}}
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                @elseif (in_array('SAD', $rolesUser))
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Username</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="username"
                                                        value="{{$user->username}}" placeholder="Username" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password"
                                                        placeholder="Password">
                                                    </div>
                                                </div>
                                                <fieldset class="form-group">
                                                    <div class="row">
                                                        <label class="col-form-label col-sm-2 pt-0">Radios</label>
                                                        <div class="col-sm-10">
                                                            @foreach ($roles as $item)
                                                            <div class="form-check disabled">
                                                                <input class="form-check-input" type="radio" name="gridRadios"
                                                                value="option3"
                                                                {{in_array($item->kode_role, $rolesUser) > 'checked' : ''}}
                                                                disabled required>
                                                                <label class="form-check-label">
                                                                    {{$item->nama_role}}
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                @endif

                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
