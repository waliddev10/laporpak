<form action="{{ route('npa.update', $item->id) }}" accept-charset="UTF-8" class="form needs-validation" id="editForm"
    autocomplete="off">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="font-weight-semibold">Jenis Usaha</label>
        <select class="form-control select2" id="jenis_usaha-field" name="jenis_usaha_id">
            <option selected="selected" disabled>Pilih Jenis Usaha</option>
            @foreach ($jenis_usaha as $ju)
            <option value="{{ $ju->id }}" @if($item->jenis_usaha_id == $ju->id) selected @endif>{{ $ju->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Volume Min</label>
        <div class="input-group">
            <input type="text" name="volume_min" class="form-control" value="{{ $item->volume_min }}" />
            <div class="input-group-append">
                <span class="input-group-text"><small>M3</small></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Volume Max</label>
        <div class="input-group">
            <input type="text" name="volume_max" class="form-control" value="{{ $item->volume_max }}" />
            <div class="input-group-append">
                <span class="input-group-text"><small>M3</small></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Nilai Sanksi Administrasi</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><small>Rp</small></span>
            </div>
            <input type="number" name="nilai" class="form-control" value="{{ $item->nilai }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Berlaku Mulai dari Tanggal:</label>
        <input type="date" name="tgl_berlaku" class="form-control" value="{{ $item->tgl_berlaku }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Keterangan</label>
        <textarea name="keterangan" class="form-control">{{ $item->keterangan }}</textarea>
    </div>

    <div class="form-group row text-right">
        <div class="col-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>

</form>

<script type="text/javascript">
    initSelect2();

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