@extends('layouts.app')

@section('content')
    <h3>Edit Riwayat Bantuan</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('bantuan_kk._form', ['bantuan' => $bantuan, 'keluarga' => $keluarga])
@endsection
