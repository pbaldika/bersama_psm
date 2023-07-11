@extends('layouts.user')
@section('content')

    <section id="projek" class="contact">
        @if (session('message'))
            <h6 class="alert alert-success">
                {{ session('message') }}
            </h6>
        @endif
        <div class="container">

            <div class="section-header">
                <h2>Buat Pemesanan Investasi</h2>
            </div>

        </div>
        <div class="container">
            <div class="row gy-5 gx-lg-5">
                <div class="col-lg-4">
                    <div class="info">
                        <h3>{{ $project->name }}</h3>
                        <p>{{ $project->description }}</p>

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Maksimum Ajuan Investasi</h4>
                                @php
                                    $available = $project->required_capital - $project->current_capital;
                                @endphp
                                <p>Rp. {{ number_format($available, 0, '.', '.') }}</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-8">
                    <div class="mb-5">
                        <form action="{{ route('place-investment', $project->id) }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="form-group mt-3">
                                    <label>Masukan Jumlah Ajuan</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="text" name="total"
                                                    class="form-control @error('total') is-invalid @enderror" id="total"
                                                    placeholder="Mohon Masukan Jumlah" required oninput="validateInput(this)">
    
                                                @error('total')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <input type="hidden" name="status" id="status" value="request">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
    
    
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Ajukan</button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-light p-3 mb-1">
                        <div class="text-center">
                        <h3 class="mb-3">INFORMASI PENGAJUAN</h3>
                        </div>
                        <p class="mb-1"><b>Sebelum Anda melakukan pengajuan, bacalah beberapa hal di bawah ini:</b></p>
                        <p class="mb-1">1. Pengajuan tidak boleh melebihi batas maksimum investasi.</p>
                        <p class="mb-1">2. Pengajuan akan diberi status "request".</p>
                        <p class="mb-1">3. Pengajuan hanya akan berhasil jika status telah diverifikasi.</p>
                        <p class="mb-0">4. Verifikasi hanya akan dilakukan setelah bukti transfer diunggah.</p>
                    </div>
                    
                </div><!-- End Contact Form -->
            </div>
        </div>


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

            function validateInput(input) {
                var total = parseFloat(input.value.replace(/\./g, '').replace(/,/g, '.')); // Parse the input value

                var availableCapital = parseFloat({{ $project->required_capital }}) - parseFloat(
                    {{ $project->current_capital }});

                if (total > availableCapital) {
                    input.value = formatCurrency(availableCapital); // Reset the input value to the available capital
                }
            }
        </script>

    @stop
