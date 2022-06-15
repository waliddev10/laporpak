@extends('layouts.app')

@section('title', 'Beranda')
@section('title.category', 'General')

@section('content')
<div class="row second-chart-list third-news-update">
    <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
        <div class="card profile-greeting">
            <div class="card-body pb-0">
                <div class="media">
                    <div class="media-body">
                        <div class="greeting-user">
                            <h4 class="f-w-600 font-primary">Selamat Pagi</h4>
                            <p>Cek jadwal Anda hari ini.</p>
                            <div class="whatsnew-btn"><a class="btn btn-primary">Cek Jadwal</a>
                            </div>
                        </div>
                    </div>
                    <div class="badge-groups">
                        <div class="badge f-10"><i class="me-1" data-feather="clock"></i><span id="clock_txt">{{
                                \Carbon\Carbon::now()->format('H:i:s') }}
                                WITA</span>
                        </div>
                    </div>
                    @push('scripts')
                    <script>
                        $(document).ready(function() {
                            startTime();
                        });
                        function startTime() {
                          const today = new Date();
                          let h = today.getHours();
                          let m = today.getMinutes();
                          let s = today.getSeconds();
                          m = checkTime(m);
                          s = checkTime(s);
                          document.getElementById('clock_txt').innerHTML =  h + ":" + m + ':' + s + ' WITA';
                          setTimeout(startTime, 1000);
                        }

                        function checkTime(i) {
                          if (i < 10) {i = "0" + i};
                          return i;
                        }
                    </script>
                    @endpush
                </div>
                <div class="cartoon">
                    <img class="img-fluid" src="{{ asset('assets/images/dashboard/cartoon.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12 xl-50 calendar-sec box-col-6">
        <div class="card gradient-primary o-hidden">
            <div class="card-body">
                <div class="default-datepicker">
                    <div class="datepicker-here" data-language="en"></div>
                </div><span class="default-dots-stay overview-dots full-width-dots"><span class="dots-group"><span
                            class="dots dots1"></span><span class="dots dots2 dot-small"></span><span
                            class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span
                            class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span
                            class="dots dots7 dot-small-semi"></span><span
                            class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">
                        </span></span></span>
            </div>
        </div>
    </div>
</div>
@endsection
