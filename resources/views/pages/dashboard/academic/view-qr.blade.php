@section('title', 'View QR')

<x-auth-layout>

    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <h1 class="display-5 coming-soon-text">QR Code</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4 text-center">

                                <img src="" id="qr-image" alt="QR Code">

                                <p class="text-muted mt-3">Expire in: <span id="countdown"></span></p>
                                <div class="mt-4 pt-2">
                                    <h5>{{ $data->course->name }}{{ $data->schedule_id }}</h5>
                                    <p class="text-muted">
                                        {{ \Carbon\Carbon::parse($data->entry_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($data->exit_time)->format('h:i A') }}
                                         | {{ $data->room->name }} - {{ $data->room->room_location }}
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> <span class="fw-semibold">Kelompok 4.</span> Crafted with <i
                                    class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script>
        $(document).ready(function () {
            let countdownTime = 20;
            let isFetching = false;

            function generateAndFetchQRCode() {
                if (isFetching) return;

                isFetching = true;
                const apiUrlSave = "{{ route('academic.attendance.save_qr', $id) }}";
                const apiUrlMake = "{{ route('academic.attendance.make_qr', $id) }}";

                $.ajax({
                    url: apiUrlSave,
                    method: 'POST',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function (response) {
                        $.ajax({
                            url: apiUrlMake,
                            method: 'GET',
                            success: function (response) {
                                if (response.qr_code) $('#qr-image').attr('src', response.qr_code);
                                isFetching = false;
                                countdownTime = 20;
                            },
                            error: function () {
                                isFetching = false;
                            }
                        });
                    },
                    error: function () {
                        isFetching = false;
                    }
                });
            }

            function updateCountdown() {
                const countdownElement = $('#countdown');
                countdownElement.text(`${countdownTime}s`);
            }

            generateAndFetchQRCode();

            setInterval(function () {
                if (!isFetching && countdownTime > 0) {
                    countdownTime -= 1;
                } else if (countdownTime <= 0) {
                    updateCountdown();
                }
                updateCountdown();
            }, 1000);

            setInterval(function () {
                if (!isFetching) {
                    generateAndFetchQRCode();
                }
            }, 20000);
        });
    </script>


</x-auth-layout>
