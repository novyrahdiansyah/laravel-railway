@extends('layouts.app')

@section('content')
<!-- MODAL QRIS -->
<div class="modal fade" id="qrisModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Scan QRIS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <img src="{{ asset('qris/qris_dummy.png') }}"
             class="img-fluid"
             style="max-width:250px;">
        <p class="mt-2 text-muted">
            Silakan scan QR untuk melakukan pembayaran
        </p>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
            Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<h4 class="mb-3">Pilih Metode Pembayaran</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <p>
            <strong>Total:</strong>
            Rp {{ number_format($transaksi->total_harga,0,',','.') }}
        </p>

        <form method="POST" action="/transaksi/{{ $transaksi->id }}/bayar">
            @csrf

            <div class="form-check mb-2">
                <input class="form-check-input"
                       type="radio"
                       name="metode_bayar"
                       value="cash"
                       id="cash"
                       checked>
                <label class="form-check-label" for="cash">
                    💵 Cash
                </label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input"
                       type="radio"
                       name="metode_bayar"
                       value="qris"
                       id="qris">
                <label class="form-check-label" for="qris">
                    📱 QRIS
                </label>
            </div>

           

            <button class="btn btn-success">
                Bayar & Cetak Struk
            </button>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cash = document.getElementById('cash');
    const qris = document.getElementById('qris');
    const qrisBox = document.getElementById('qrisBox');

    function toggleQRIS() {
        if (qris.checked) {
            qrisBox.style.display = 'block';
        } else {
            qrisBox.style.display = 'none';
        }
    }

    cash.addEventListener('change', toggleQRIS);
    qris.addEventListener('change', toggleQRIS);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cash = document.getElementById('cash');
    const qris = document.getElementById('qris');
    const modal = new bootstrap.Modal(document.getElementById('qrisModal'));

    qris.addEventListener('change', function () {
        if (qris.checked) {
            modal.show();
        }
    });

    cash.addEventListener('change', function () {
        modal.hide();
    });
});
</script>


@endsection
