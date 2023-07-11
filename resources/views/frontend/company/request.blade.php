@extends('layouts.user')
@section('content')
    <!-- ======= Contact Section ======= -->
    <section id="pengajuan" class="pengajuan">
        @if (session('message'))
            <h6 class="alert alert-success">
                {{ session('message') }}
            </h6>
        @elseif ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container">
            <div class="section-header">
                <h2>Permohonan Pendanaan</h2>
                <p>Ingin membuat pengajuan dana? Anda bisa melakukannya di Bersama. Bila kalian ingin menambahkan pendanaan
                    projek kalian, isi informasi dibawah ini.</p>
            </div>
        </div>
        <div class="container">
        </div>

        <div class="container col-lg-8">
            <form action="{{ route('create-funding') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="form-group mt-3">
                        <label>Nama Pendanaan</label>
                        <input type="text" name="fundName"
                            class="form-control mt-3 @error('fundName') is-invalid @enderror" id="fundName"
                            placeholder="Mohon Masukan Nama Pendanaan Kalian" required>
                        @error('fundName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label>Total Keperluan Dana</label>
                        <div class="input-group mt-3">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" name="fund_required"
                                class="form-control @error('fund_required') is-invalid @enderror" id="total"
                                placeholder="Mohon Masukan Keperluan Dana Kalian" required oninput="validateInput(this)">

                            @error('fund_required')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 form-outline mt-3">
                        <label for="profit_margin_bersama">Margin Keuntungan Anda</label>
                        <div class="input-group">
                            <input id="profit_margin_user" type="number" min="0" max="100"
                                class="form-control @error('profit_margin_user') is-invalid @enderror"
                                name="profit_margin_user" required autocomplete="profit_margin_user"
                                oninput="updateMargins(this.id, this.value)">

                            <span class="input-group-text">%</span>
                        </div>
                        @error('profit_margin_bersama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-outline mt-3">
                        <label for="profit_margin_investor">Margin Keuntungan Investor</label>
                        <div class="input-group">
                            <input id="profit_margin_investor" type="number" min="0" max="100"
                                class="form-control @error('profit_margin_investor') is-invalid @enderror"
                                name="profit_margin_investor" required autocomplete="profit_margin_investor"
                                oninput="updateMargins(this.id, this.value)">

                            <span class="input-group-text">%</span>
                        </div>
                        @error('profit_margin_investor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group mt-3">
                        <label>Deskripsi Pendanaan</label>
                        <textarea name="description" class="form-control mt-3 @error('description') is-invalid @enderror" id="description"
                            placeholder="Masukan Deskripsi dan Alasan Pengumpulan Dana" style="height: 150px;" required></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Nama Pengaju Pemesanan Barang</label>
                        <input type="text" name="customerName"
                            class="form-control mt-3 @error('CustomerName') is-invalid @enderror" id="customerName"
                            placeholder="Masukan Nama Pengaju Pemesanan di Projek Kalian" required>

                        @error('customerName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Barang Pemesanan Pengaju</label>
                        <input type="text" name="customerOrder"
                            class="form-control mt-3 @error('CustomerOrder') is-invalid @enderror" id="customerOrder"
                            placeholder="Masukan Barang Pemesanan di Projek Kalian" required>

                        @error('customerOrder')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Tanggal Mulai Pendanaan</label>
                        <input type="date" name="start_date"
                            class="form-control mt-3 @error('start_date') is-invalid @enderror" id="start_date"
                            placeholder="Masukan Tanggal Pemulain Pengumpulan Dana" min="{{ date('Y-m-d') }}" required>

                        @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Tanggal Selesai Pendanaan</label>
                        <input type="date" name="end_date"
                            class="form-control mt-3 @error('end_date') is-invalid @enderror" id="end_date"
                            placeholder="Masukan Estimasi Tanggal Barang Diterima" required>

                        @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Informasi Tambahan</label>
                        <p><i class="bi bi-exclamation-circle-fill text-primary"></i> <small><em>Masukan Informasi Tambahan
                                    Seperti Link Pejelasan Barang</em></small></p>
                        <input type="text" name="additional_info"
                            class="form-control mt-3 @error('additional_info') is-invalid @enderror" id="additional_info"
                            placeholder="www.example.com">

                        @error('additional_info')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Upload Contoh Gambar Barang</label>
                        <p><i class="bi bi-exclamation-circle-fill text-primary"></i> <small><em>Masukan Contoh Foto
                                    Pesanan</em></small></p>
                        <input type="file" class="form-control  @error('order_photo') is-invalid @enderror"
                            name="order_photo" id="order_photo">

                        @error('order_photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <input id="verified" type="hidden" name="verified" value="request">
                {{-- <input type="hidden" name="customerName" id="customerName" value="{{ Auth::user()->name }}"> --}}
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="status" id="status" value="request">
                {{-- <input type="hidden" name="start_date" id="start_date" value="{{ now() }}"> --}}
                {{-- <input type="hidden" name="company_registration_number" id="company_registration_number"
                    value="{{ Auth::user()->IDNumber }}"> --}}


                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-success btn-lg">Upload Pemesanan</button>
                </div>

                <!-- <div class="my-3">
                                                                                                                <div class="loading">Loading</div>
                                                                                                                <div class="error-message"></div>
                                                                                                                <div class="sent-message">Your order has been processed. Thank you!</div>
                                                                                                              </div> -->
            </form>
        </div><!-- End Contact Form -->


        <script>
            // Get the input element
            const totalInput = document.getElementById('total');

            // Add event listener for form submission
            totalInput.closest('form').addEventListener('submit', function() {
                // Remove dots from the input value
                totalInput.value = totalInput.value.replace(/\./g, '');
            });

            // Add event listener for input
            totalInput.addEventListener('input', function() {
                // Remove existing dots from the input value
                let value = this.value.replace(/\./g, '');

                // Add dots after every three digits
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Set the formatted value back to the input
                this.value = value;
            });

            function updateMargins(id, value) {
                value = parseInt(value);
                var bersamaInput = document.getElementById('profit_margin_user');
                var investorInput = document.getElementById('profit_margin_investor');

                if (!isNaN(value)) {
                    if (id === 'profit_margin_user') {
                        if (value > 100) {
                            value = 100;
                        }
                        investorInput.value = 100 - value;
                    } else if (id === 'profit_margin_investor') {
                        if (value > 100) {
                            value = 100;
                        }
                        bersamaInput.value = 100 - value;
                    }
                }
            }
        </script>
    @stop
