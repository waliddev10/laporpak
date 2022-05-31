<form action="{{ route('laporan_bulanan.store', $payment_point->id) }}" accept-charset="UTF-8"
    class="form needs-validation" id="createForm" autocomplete="off">
    @csrf
    <input type="hidden" name="jenis_pkb_id" value="{{ $jenis_pkb->id }}" />

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>Pembayaran</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Tanggal Bayar</label>
                    <input type="date" name="tgl_bayar" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">No. Polisi</label>
                    <div class="row">
                        <div class="col-3">
                            <input type="text" name="awalan_no_pol" class="form-control" value="KT" />
                        </div>
                        <div class="col-6">
                            <input type="number" name="no_pol" class="form-control" />
                        </div>
                        <div class="col-3">
                            <input type="text" name="akhiran_no_pol" class="form-control" />
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
                    <input type="date" name="tgl_cetak" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">No. SKPD</label>
                    <input type="number" name="no_skpd" class="form-control" />
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
                        <input class="form-check-input" type="radio" name="wilayah_id" id="wilayah_id_{{ $wil->id }}"
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
                        <input class="form-check-input" type="radio" name="kasir_id" id="kasir_id_{{ $kas->id }}"
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
                    <input type="number" name="nilai_pokok" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Denda <span class="badge badge-secondary">Rp.</span></label>
                    <input type="number" name="nilai_denda" class="form-control" />
                </div>
            </div>

            <div class="form-group mt-5 row text-right">
                <div class="col-12">
                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Laporkan</button>
                </div>
            </div>
        </div>
    </div>

</form>

<script type="text/javascript">
    $("#createForm").on('submit', function(event) {
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
                }else{
                    showAlert(response.message, 'warning')
                }
            }
        });
        return false;
    });
</script>