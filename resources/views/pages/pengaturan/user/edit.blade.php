<form action="{{ route('user.update', $item->id) }}" accept-charset="UTF-8" class="form needs-validation" id="editForm"
    autocomplete="off">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label class="font-weight-semibold">Nama User</label>
        <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $item->email }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">NIP</label>
        <input type="number" name="nip" class="form-control" value="{{ $item->nip }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Jabatan</label>
        <input type="text" name="jabatan" class="form-control" value="{{ $item->jabatan }}" />
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Role</label>
        <select name="role" class="form-control">
            <option selected disabled>Pilih Role...</option>
            <option value="admin" @if($item->role == 'admin') selected @endif>Admin</option>
            <option value="user" @if($item->role == 'user') selected @endif>User</option>
        </select>
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