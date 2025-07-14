@extends('layouts.member')

@section('js')
    <script>
        aksi()

        function aksi() {

            localStorage.removeItem('member_id')
            localStorage.removeItem('listCheckout')
            localStorage.removeItem('checkout')
            localStorage.removeItem('produkItem')
            localStorage.removeItem('listKeranjang')
            localStorage.removeItem('invoice')
            localStorage.removeItem('dataTransaksi')
            window.location.href = '/'
        }
    </script>
@endsection

@section('content')
@endsection
