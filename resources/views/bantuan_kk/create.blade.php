@extends('layouts.app')

@section('content')
    <h3>Tambah Riwayat Bantuan</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('bantuan_kk._form', ['keluarga' => $keluarga])
@endsection
