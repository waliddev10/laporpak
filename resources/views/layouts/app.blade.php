<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="{{ config('app.description') }}" />
    <meta name="author" content="{{ config('app.author') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@hasSection('title') @yield('title') - {{ config('app.name') }} @else {{ config('app.name') }} @endif</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    {{--
    <link href="{{ asset('assets/css/sb-admin-2.css').'?v='.Str::random(5) }}" rel="stylesheet"> --}}

    <link href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @stack('styles')

</head>

<body id="page-top">
    <div id="wrapper">
        @include('partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('partials.navbar')
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
    @include('components.scroll-to-top')

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/sb-admin-2.js').'?v='.Str::random(5) }}"></script> --}}

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ajaxError(function(event, xhr, settings, thrownError) {
            if (xhr.status == 422) {
                message = '';
                type = 'warning';

                $('.form.needs-validation').find('input, select, textarea').removeClass('is-invalid');
                $('.form.needs-validation').find('.select2').removeClass('border border-danger');
                $('.invalid-feedback').remove();
                $.each(xhr.responseJSON.errors, function(name, message) {
                    $('[name="' + name + '"]').addClass('is-invalid').after('<div class="invalid-feedback">' + message  + '</div>');
                    $('.select2[name="' + name + '"]').next('.select2').addClass(
                        'border border-danger').after('<div class="invalid-feedback">' + message  + '</div>');
                });
            } else if (xhr.status == 401 || xhr.status == 419) {
                message = 'Sesi login habis, silakan muat ulang browser Anda dan login kembali.';
                type = 'warning';
                $('.modal').modal('hide');
                showAlert(message, type);
            } else if (xhr.status == 500) {
                message = 'Terjadi kesalahan, silakan muat ulang browser Anda dan hubungi Admin.';
                type = 'danger';
                $('.modal').modal('hide');
                showAlert(message, type);
            }
        });

        function initSelect2() {
            $('select.select2:not(.select2-hidden-accessible)').select2({
                allowClear: false,
                width: '100%'
            });
        }
    </script>
    <script type="text/javascript">
        // Global Settings DataTables Search
        $(document).on('init.dt', function (e, settings) {
            var api = new $.fn.dataTable.Api(settings);
            var inputs = $(settings.nTable).closest('.dataTables_wrapper').find('.dataTables_filter input');
    
            inputs.unbind();
            inputs.each(function (e) {
                var input = this;
    
                function disableSubmitOnEnter(form) {
                    if (form.length) {
                        form.on('keyup keypress', function (e) {
                            var keyCode = e.keyCode || e.which;
    
                            if (keyCode == 13) {
                                e.preventDefault();
                                return false;
                            }
                        });
                    }
                }
                disableSubmitOnEnter($(input).closest('form'));
    
                $(input).bind('keyup', function (e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
    
                $(input).bind('input', function (e) {
                    if (this.value == '') {
                        api.search(this.value).draw();
                    }
                });
            });
        });
    
        function setLoader() {
            return '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"></div></div>';
        }
    
        $('#modalContainer').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            var title = button.data('title')
            var href = button.attr('href')
            modal.find('.modal-title').html(title)
            modal.find('.modal-body').html(setLoader())
            $.get(href).done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        });
    
        function showAlert(message, type = 'success', reload = false) {
            if (type == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: message,
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    allowEnterKey: false
                })
            } else {
                if (type == 'danger') {
                    type = 'error';
                }
    
                Swal.fire({
                    title: type.toUpperCase()+'!',
                    html: message,
                    icon: type
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (reload) {
                            showLoading();
                            window.location.reload();
                        }
                    }
                });
            }
        }
    </script>
    <script type="text/javascript">
        $('body').on("click", ".delete", function(event){
            event.preventDefault();
            var href = $(this).attr("href");
            var dataTargetTable = $(this).data('target-table');
    
            Swal.fire({
                title: 'Anda yakin akan menghapus data ini?',
                text: "Periksa kembali data anda sebelum menghapus!",
                icon: 'warning',
                showCancelButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                allowEnterKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: href,
                        type: 'DELETE',
                        success: function(response) {
                            if(response.status == 'success'){
                                $("#modalContainer").modal('hide');
                                showAlert(response.message, 'success');
                                window[dataTargetTable].ajax.reload(null, false);
                            }else{
                                showAlert(response.message, response.status);
                            }
                        }
                    });
                }
            })
        });
    </script>

    @stack('scripts')
</body>

</html>