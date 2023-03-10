<div style="width:96%;margin:auto;" id="content-popup">
    <br/>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTable-penjualan-umkm-barang" cellspacing="0" width="100%" id="table-media_<?=$id_count;?>">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    $('#table-media_<?php echo $id_count; ?>').on('click', 'tbody tr', function(e){
        e.preventDefault();
        $('#id_supplier_<?= $id_count; ?>').val($(this).find('td').html());
        $('#nama_supplier_<?= $id_count; ?>').val($(this).find('td').next().html());
        $.colorbox.close();
    });	

    $('.dataTable-penjualan-umkm-barang').dataTable({
        processing: true,
        serverSide: true,
        ajax: "<?=url('backend/browse-supplier-umkm/datatable');?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'alamat', name: 'alamat'}
        ],
        responsive: true
    });
</script>