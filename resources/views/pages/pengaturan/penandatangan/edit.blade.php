<form action="{{ route('penandatangan.update', $item->id) }}" accept-charset="UTF-8" class="form needs-validation"
    id="editForm" autocomplete="off">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label class="font-weight-semibold">Nama Penandatangan</label>
        <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Jabatan</label>
        <input type="text" name="jabatan" class="form-control" value="{{ $item->jabatan }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Pangkat</label>
        <input type="text" name="pangkat" class="form-control" value="{{ $item->pangkat }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Golongan</label>
        <input type="text" name="golongan" class="form-control" value="{{ $item->golongan }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">NIP</label>
        <input type="text" name="nip" class="form-control" value="{{ $item->nip }}" />
    </div>

    <div class="form-group row text-right">
        <div class="col-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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