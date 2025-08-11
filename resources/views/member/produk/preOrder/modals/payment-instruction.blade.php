<div id="invoiceModal" class="modal fade" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel"><strong>Pembayaran Pesanan</strong></h5>
            </div>
            <div class="modal-body">
                <div>
                    <label for="orderId"><b>No. Pesanan</b></label>
                    <p id="orderId" class="text-lg font-medium"></p>
                </div>
                <div>
                    <label for="expiry_time"><b>Batas Waktu Pembayaran</b></label>
                    <p id="expiry_time" class="text-lg font-medium"></p>
                </div>
                <div>
                    <label for="amount"><b>Jumlah</b></label>
                    <p id="amount" class="text-lg font-medium"></p>
                </div>
                <div>
                    <label for="status"><b>Status Pesanan</b></label>
                    <p id="status" class="text-lg font-medium"></p>
                </div>
                <div>
                    <label for="payment_instructions"><b>Instruksi Pembayaran</b></label>
                    <div id="payment_instruction_header"></div>
                    <div id="payment_instructions" class="mt-2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="confirmPaymentBtn" class="btn btn-primary">Saya Sudah Bayar</button>
                <!-- <button id="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>