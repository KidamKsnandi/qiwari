@extends('layouts.member')

@section('js')
    <script>
        aksi()

        function aksi() {

            localStorage.removeItem('user')
            localStorage.removeItem('token')
            window.location.href = '/'
        }
    </script>
@endsection

@section('content')
@endsection
