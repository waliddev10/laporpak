<form action="{{ route('user.update', $item->id) }}" accept-charset="UTF-8" class="form needs-validation" id="editForm"
    autocomplete="off">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="mt-2">
                <label class="form-label">Nama User</label>
                <input type="text" name="nama" class="form-control input-air-primary" value="{{ $item->nama }}" />
            </div>
            <div class=" mt-2">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control input-air-primary" value="{{ $item->email }}" />
            </div>
            <div class=" mt-2">
                <label class="form-label">NIP</label>
                <input type="number" name="nip" class="form-control input-air-primary" value="{{ $item->nip }}" />
            </div>
            <div class=" mt-2">
                <label class="form-label">Password</label>
                <input type="text" name="password" class="form-control input-air-primary" />
            </div>
            <div class=" mt-2">
                <label class="form-label">No. Handphone</label>
                <input type="number" name="no_hp" class="form-control input-air-primary" value="{{ $item->no_hp }}" />
            </div>
        </div>
        <div class="col">
            <div class="mt-2">
                <label class="form-label">Pangkat</label>
                <select name="pangkat_id" class="form-select input-air-primary">
                    <option disabled selected>Pilih Pangkat</option>
                    @foreach ($pangkat as $pangkat)
                    <option value="{{ $pangkat->id }}" @if($pangkat->id == $item->pangkat_id) selected @endif>{{
                        $pangkat->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label class="form-label">Bidang</label>
                <select name="bidang_id" class="form-select input-air-primary">
                    <option disabled selected>Pilih Bidang</option>
                    @foreach ($bidang as $bidang)
                    <option value="{{ $bidang->id }}" @if($bidang->id == $item->bidang_id) selected @endif>{{
                        $bidang->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control input-air-primary" value="{{ $item->jabatan }}" />
            </div>
            <div class="mt-2">
                <label class="form-label">Role</label>
                <select name="role" class="form-select input-air-primary">
                    <option selected disabled>Pilih Role...</option>
                    <option value="admin" @if($item->role == 'admin') selected @endif>Admin</option>
                    <option value="user" @if($item->role == 'user') selected @endif>User</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mt-5 text-right">
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
