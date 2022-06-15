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

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    @stack('styles')

</head>

<body>
    @include('components.loader')

    <div class="tap-top">
        <i data-feather="chevrons-up"></i>
    </div>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">

        @include('components.navbar')

        <div class="page-body-wrapper">

            @include('components.sidebar')

            <div class="page-body">
                @hasSection('title')
                @include('components.breadcrumb')
                @endif

                <div class="container-fluid">
                    @hasSection('content')
                    @yield('content')
                    @endif
                </div>

            </div>

            @include('components.footer')
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/notify/index.js') }}"></script> --}}
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script> --}}
    <!-- login js-->
    <!-- Plugin used-->

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
    <script>
        $(document).ajaxStart(function () {
            $("button").attr("disabled", "disabled");
            $("input").attr("disabled", "disabled");
            $("select").attr("disabled", "disabled");
            $("textarea").attr("disabled", "disabled");
        }).ajaxComplete(function(){
            $("button").removeAttr("disabled");
            $("input").removeAttr("disabled");
            $("select").removeAttr("disabled");
            $("textarea").removeAttr("disabled");
        });
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
                                // $("#modalContainer").modal('hide');
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

{{-- <div id="wrapper">
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
@include('components.scroll-to-top') --}}

</html>
