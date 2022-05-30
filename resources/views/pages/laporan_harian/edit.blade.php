<form action="{{ route('laporan_harian.update', ['payment_point' => $payment_point->id, 'esamsat' => $item->id]) }}"
    accept-charset="UTF-8" class="form needs-validation" id="editForm" autocomplete="off">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>Pembayaran</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Jenis PKB</label>
                    @foreach ($jenis_pkb as $pkb)
                    <div class="form-check">
                        <input @if($pkb->id == $item->jenis_pkb_id) checked @endif class="form-check-input" type="radio"
                        name="jenis_pkb_id" id="jenis_pkb_id_{{ $pkb->id }}"
                        value="{{ $pkb->id }}">
                        <label class="form-check-label" for="jenis_pkb_id_{{ $pkb->id }}">
                            {{ $pkb->nama }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Tanggal Bayar</label>
                    <input type="date" name="tgl_bayar" class="form-control" value="{{ $item->tgl_bayar }}" />
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">No. Polisi</label>
                    <div class="row">
                        <div class="col-3">
                            <input type="text" name="awalan_no_pol" class="form-control"
                                value="{{ $item->awalan_no_pol }}" />
                        </div>
                        <div class="col-6">
                            <input type="number" name="no_pol" class="form-control" value="{{ $item->no_pol }}" />
                        </div>
                        <div class="col-3">
                            <input type="text" name="akhiran_no_pol" class="form-control"
                                value="{{ $item->akhiran_no_pol }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>SKPD</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Tanggal Cetak</label>
                    <input type="date" name="tgl_cetak" class="form-control" value="{{ $item->tgl_cetak }}" />
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">No. SKPD</label>
                    <input type="number" name="no_skpd" class="form-control" value="{{ $item->no_skpd }}" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>Wilayah</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Kota</label>
                    @foreach ($wilayah as $wil)
                    <div class="form-check">
                        <input @if($wil->id == $item->wilayah_id) checked @endif class="form-check-input" type="radio"
                        name="wilayah_id" id="wilayah_id_{{ $wil->id }}"
                        value="{{ $wil->id }}">
                        <label class="form-check-label" for="wilayah_id_{{ $wil->id }}">
                            {{ $wil->nama }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Jenis Kasir</label>
                    @foreach ($kasir as $kas)
                    <div class="form-check">
                        <input @if($kas->id == $item->kasir_id) checked @endif class="form-check-input" type="radio"
                        name="kasir_id" id="kasir_id_{{ $kas->id }}"
                        value="{{ $kas->id }}">
                        <label class="form-check-label" for="kasir_id_{{ $kas->id }}">
                            {{ $kas->nama }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>Nilai PKB</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Pokok <span class="badge badge-secondary">Rp.</span></label>
                    <input type="number" name="nilai_pokok" class="form-control" value="{{ $item->nilai_pokok }}" />
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Denda <span class="badge badge-secondary">Rp.</span></label>
                    <input type="number" name="nilai_denda" class="form-control" value="{{ $item->nilai_denda }}" />
                </div>
            </div>

            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>E-SAMSAT</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Status E-SAMSAT</label>
                    @php
                    $status_esamsat = [
                    (object) [
                    'nama' => 'Iya',
                    'value' => 1,
                    ],
                    (object) [
                    'nama' => 'Tidak',
                    'value' => 0,
                    ],
                    ];
                    @endphp
                    @foreach ($status_esamsat as $se)
                    <div class="form-check">
                        <input @if($se->value == $item->status_esamsat) checked @endif class="form-check-input"
                        type="radio" name="status_esamsat"
                        id="status_esamsat_{{ $se->nama }}" value="{{ $se->value }}">
                        <label class="form-check-label" for="status_esamsat_{{ $se->nama }}">
                            {{ $se->nama }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Kasir Pembayaran</label>
                    <select name="kasir_pembayaran_id" class="form-control">
                        <option selected disabled>Pilih Kasir Pembayaran...</option>
                        @foreach ($kasir_pembayaran as $kp)
                        <option value="{{ $kp->id }}" @if($kp->id == $item->kasir_pembayaran_id) selected @endif>{{
                            $kp->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mt-5 row text-right">
                <div class="col-12">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>

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