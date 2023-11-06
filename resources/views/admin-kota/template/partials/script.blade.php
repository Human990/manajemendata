<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $("#selectStatus").select2({
            placeholder: 'Pilih Status Pegawai',
        });

        $('.select2jabatan').select2({
            placeholder: 'Pilih Jabatan',
            allowClear: true // Menambahkan opsi untuk menghapus pilihan
        });
        $('#opd_filter').val($('#opd_hidden').val());
        
        $('.select2').select2();

        $('#filterBtn').click(function(){
                var opdId = $('#opd_filter').val();
                var searchQuery = $('#search').val();

                // Redirect to the URL with the selected OPD filter
                window.location.href = "{{ route('adminkota-tpp-pegawai') }}?opd=" + opdId + "&search=" + searchQuery;
            });
    });
</script>
