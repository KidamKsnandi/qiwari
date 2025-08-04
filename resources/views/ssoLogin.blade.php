@extends('layouts.member')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script src="{{ asset('lib/select2.min.js') }}"></script>

    <script>
        $(".theSelect").select2();
    </script>

    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');

        logout()
        loginEmail()

        function logout() {
            localStorage.removeItem('user')
            localStorage.removeItem('token')
        }

        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        function loginEmail() {
            const email = getQueryParam('email'); // ambil email dari parameter URL

            if (!email) {
                console.error('Email tidak ditemukan di URL');
                return;
            }
            const data = { email };

            const headers = {
                'secret': API_SECRET,
                'device': 'web',
            }

            axios.post(`${API_URL}/v1/auth/sso-login`, data, {
                    headers: headers
                })
                .then(function(response) {
                    console.log(response.data);
                    localStorage.setItem('token', response.data.token)
                    localStorage.setItem('user', JSON.stringify(response.data.user))
                    window.location.href = "/member/pre-order/member-card";
                })
                .catch(function(error) {
                    console.log(error);
                });

        }

    </script>
@endsection
