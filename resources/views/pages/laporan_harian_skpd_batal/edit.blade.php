<form
    action="{{ route('laporan_harian_skpd_batal.update', ['payment_point' => $payment_point->id, 'esamsat' => $item->id]) }}"
    accept-charset="UTF-8" class="form needs-validation" id="editForm" autocomplete="off">
    @csrf
    @method('PUT')

    <div class="form-group">
        <h3 class="font-weight-semibold">No. {{ $item->no_skpd }}</h3>
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Keterangan Batal</label>
        <textarea name="keterangan" class="form-control">{{ $item->keterangan }}</textarea>
    </div>

    <div class="form-group mt-5 row text-right">
        <div class="col-12">
            <button type="submit" class="btn btn-danger"><i class="fa fa-ban"></i> Batalkan SKPD</button>
        </div>
    </div>

</form>

<script type="text/javascript">
    $("#editForm").on('submit', function(event) {
        event.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status == 'success')
                {
                    $("#modalContainer").modal('hide');
                    tableDokumen.ajax.reload(null, false);
                    showAlert(response.message, 'success')
                } else {
                    showAlert(response.message, 'warning')
                }
            }
        });
        return false;
    });
</script>