<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('lib/axios.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var tokenEmail = "{{ $slug }}"
    var formData = new FormData();
    var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
    var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');

    formData.append('token', tokenEmail);

    axios.post(`${API_URL}/v1/complete-checkout`, formData, {
            headers: {
                'secret': API_SECRET,
                'device': 'web'
            }
        })
        .then(function(response) {
            Swal.fire('Terima kasih!', 'Belanja lagi nanti yah!!', 'success');
            // localStorage.setItem('res', JSON.stringify(response.data))
            window.location.href = "/list-transaksi";
        })
        .catch(function(error) {
            Swal.fire('Maaf!', "Link Sudah Kadaluarsa", 'danger');
            window.location.href = "/list-transaksi";
        });
</script>
