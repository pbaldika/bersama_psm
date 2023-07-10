@extends('layouts.user')
@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Detail Projek</h2>
            </div>
            <div name="main" class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-5">
                    <div class="about-img">
                        <img src="{{ url('pro/' . $project->project_photo) }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <h3 class="pt-0 pt-lg-5">{{ $project->name }}</h3>
                    @if ($project->progress_status == 'selesai')
                        <button type="button" class="btn btn-primary" disabled>Projek Selesai</button>
                    @elseif ($project->required_capital == $project->current_capital)
                        <button type="button" class="btn btn-primary" disabled>Investasi Penuh</button>
                    @else
                        <a href="{{ route('place-start', $project->id) }}"><button type="button"
                                class="btn btn-primary">Ajukan Investasi</button></a>
                    @endif
                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3">
                        <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">Ringkasan</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">Menghitung Keuntungan</a></li>
                    </ul><!-- End Tabs -->
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div class="tab-pane container bg-light mt-4 active" id="tab1">
                            <p class="fst-italic">{{ $project->description }}
                            </p>
                            @php
                                $currentCapital = (float) $project->current_capital;
                                $requiredCapital = (float) $project->required_capital;
                                $value = ($currentCapital / $requiredCapital) * 100;
                            @endphp
                            <div class="pt-2">
                                <p class="mb-2">Dana Telah Terkumpulkan {{ $value }}%</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $value }}%;"
                                        aria-valuenow={{ $value }} aria-valuemin="0" aria-valuemax="100">
                                        {{ number_format($value, 2) }}%</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column mt-3 mb-3">
                                        <p class="mb-2">Dana Yang Diperlukan</p>
                                        <p class="fw-bold mb-2">Rp.
                                            {{ number_format($project->required_capital, 0, '.', '.') }}</p>
                                    </div>
                                    <div class="d-flex flex-column mt-3 mb-1">
                                        <p class="mb-2">Margin Nisbah</p>
                                        <p class="mb-0">Bersama: <b>{{ $project->profit_margin_bersama }}%</b></p>
                                        <p class="mb-0">Investor: <b>{{ $project->profit_margin_investor }}%</b></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column mt-3 mb-3">
                                        <p class="mb-2">Dana Yang Telah Terkumpulkan</p>
                                        <p class="fw-bold mb-2">Rp.
                                            {{ number_format($project->current_capital, 0, '.', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane container fade show bg-light" id="tab2">
                            <h3>Cari Tahu Tentang Keuntungan</h3>
                            <p class="mt-2">Di sini, Anda dapat mengetahui potensi keuntungan dari investasi Anda.
                                <br><br>Margin dari proyek ini sangat penting untuk Anda pahami! Mari kita letakkan
                                hipotesis jika proyek ini memiliki keuntungan bersih sebesar 10 juta rupiah dan semua dana
                                akan terkumpulkan.
                            </p>
                            <p>Bagimana cara keuntungan dihitung?</p>

                            <p>Keuntungan 10 Juta yang didaptkan projek ini akan dibagi berdasarkan margin yang ada. Maka di
                                projek ini: </p>
                            @php
                                $keuntungan_bersama = 10000000 * ($project->profit_margin_bersama / 100);
                                $keuntungan_investor = 10000000 * ($project->profit_margin_investor / 100);
                            @endphp
                            <p><b>Keuntungan Bersama</b>: Rp. 10.000.000 X {{ $project->profit_margin_bersama }}% = Rp.
                                {{ number_format($keuntungan_bersama, 0, '.', '.') }}</p>
                            <p><b>Keutungan Semua Investor</b>: Rp. 10.000.000 X {{ $project->profit_margin_investor }} = Rp.
                                {{ number_format($keuntungan_investor, 0, '.', '.') }}</p>

                            <p>Keuntungan kalian akan dikalkulasi berdasarkan</p>
                            <p><b>(Investasi Kalian / Dana investasi yang terkumpulkan) X Keuntungan Semua Investor</b></p>
                            <label>Masukan Jumlah Investasi Kalian</label>
                            <div class="input-group mt-2">
                                <span class="input-group-text">Rp.</span>
                                <input id="total" type="text" onkeyup="formatCurrency(this)"
                                    onblur="removeSeparators(this)"
                                    class="form-control @error('total') is-invalid @enderror" name="total">
                            </div>

                            <button type="button" onclick="calculateProfit()"
                                class="btn btn-primary d-block mx-auto mt-2 mb-2">Hitung</button>

                            <div class="mb-2"id="profitResult" style="display: none;">
                                <p><b>Keuntungan Anda: <span id="profitValue"></span></b></p>
                            </div>
                            {{-- <p><b>Keuntungan kalian</b>: = Rp. {{ number_format($total, 0, '.', '.') }} / Rp. {{ number_format($project->required_capital, 0, '.', '.') }} X {{ number_format($keuntungan_investor, 0, '.', '.') }} </p> --}}
                        </div><!-- End Tab 1 Content -->
                    </div>
                </div>
            </div>

            <div name="main" class="row g-4 g-lg-5 mt-5" data-aos="fade-up" data-aos-delay="200">
                <h3>Tata Cara Investasi</h3>
                <div class="d-flex align-items-center mt-4">
                    <i class="bi bi-check2"></i>
                    <h4> Baca Informasi Proyek</h4>
                </div>
                <p>Sebelum mengajukan permohonan investasi, bacalah terlebih dahulu informasi yang tertera,
                    seperti dana yang diperlukan, dana yang terkumpul, dan margin keuntungan yang diharapkan.
                </p>

                <div class="d-flex align-items-center mt-4">
                    <i class="bi bi-check2"></i>
                    <h4> Ajukan Jumlah Investasi</h4>
                </div>
                <img src="{{ url('Image/Foto Ajukan.png') }}" class="mx-auto img-fluid mb-3 bg-primary"
                    alt="contoh foto identitas" style="width:60%">
                <p>Jika Anda ingin memulai investasi, klik tombol "Ajukan Investasi". Anda akan diarahkan ke
                    halaman baru dan diminta untuk memasukkan jumlah uang yang ingin Anda investasikan. Pastikan
                    jumlah investasi Anda tidak melebihi investasi yang tersedia!</p>

                <div class="d-flex align-items-center mt-4">
                    <i class="bi bi-check2"></i>
                    <h4> Unggah Foto Investasi Anda</h4>
                </div>
                <img src="{{ url('Image/Foto Verifikasi.png') }}" class="mx-auto img-fluid mb-3 bg-primary"
                    alt="contoh foto identitas" style="width:60%">
                <p>Setelah mengajukan investasi, Anda harus mengunggah bukti pembayaran ke akun bank kami. Anda
                    dapat mengunggah foto slip transfer atau foto transfer melalui m-banking. Investasi Anda
                    tidak akan diverifikasi jika tidak ada bukti pembayaran!
                </p>

                <div class="d-flex align-items-center mt-4">
                    <i class="bi bi-check2"></i>
                    <h4> Tunggu Hingga Selesai</h4>
                </div>
                <p>Setelah investasi Anda diverifikasi, Anda harus menunggu hingga proyek selesai. Setelah
                    proyek selesai, Anda akan menerima hasil investasi melalui transfer bank.</p>

            </div><!-- End Tab 1 Content -->
        </div>
        </div>
    </section><!-- End About Section -->

    <script>
        function formatCurrency(input) {
            var value = input.value.replace(/\./g, ''); // Remove existing dots

            var formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g,
                '.'); // Add dots as separators for each group of three digits

            input.value = formattedValue; // Update the input value with the formatted value
        }

        function removeSeparators(input) {
            var value = input.value;
            value = value.replace(/,/g, '');
            input.value = value;
        }

        function calculateProfit() {
            var total = parseFloat(document.getElementById('total').value.replace(/\./g, '').replace(/,/g, '.'));
            var profitMarginInvestor = parseFloat({{ $project->profit_margin_investor }});
            var requiredCapital = parseFloat({{ $project->required_capital }});
            var profitAllInvestor = (profitMarginInvestor / 100) * 10000000;
            var profitInvestor = (total / requiredCapital) * profitAllInvestor;

            var formattedProfit = new Intl.NumberFormat('id-ID').format(profitInvestor);

            var formattedIntegerPart = formattedProfit.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            var result = 'Rp. ' + formattedIntegerPart;

            document.getElementById('profitValue').textContent = result;
            document.getElementById('profitResult').style.display = 'block';
        }
    </script>
@stop
