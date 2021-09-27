<?php $v->layout("_theme"); ?>
<?php $v->start("styles"); ?>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.material.min.css">
<style>
    #table_wrapper {
        width: 100%;
        border: none;
        font-family: 'Roboto', sans-serif;
    }

    .mdc-button--raised:not(:disabled) {
        background-color: #009237;
    }

    div.dataTables_wrapper div.mdc-layout-grid {
        padding: 12px 0;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        border: 1px solid #E0E0E0;
        border-radius: 8px;
        width: 385px;
    }

    div.dataTables_wrapper .mdc-data-table__cell {
        text-align: left;
    }
</style>
<?php $v->end("styles"); ?>



<div class="cadPrivate">
    <div class="flex begin w100">
        <h1>Cadastro Nota Digital</h1><br>
        <a href="<?= url("/nota") ?>" class="btn btn-small icon-plus-1 btn-green_default radius_50 transition">New
            Order</a>
    </div>
    <h2>Dados da Origem</h2>
    <div class="ajax_response"><?= flash(); ?></div>
    <br>
    <table id="table" class="mdl-data-table" style="width: 100%">
        <thead>
        <tr>
            <th width="20">Nº</th>
            <th width="300">Client Source</th>
            <th width="300">Client Destiny</th>
            <th width="100">Date</th>
            <th width="100">Total</th>
            <th width="50">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($order): ?>
            <?php foreach ($order as $o): ?>
                <tr>
                    <td><?= str_pad($o->id, 4, 0, STR_PAD_LEFT); ?></td>
                    <td><?= $o->client_origem ?></td>
                    <td><?= $o->client_dest ?></td>
                    <td><?= date_fmt($o->created_at, "d/m/Y"); ?></td>
                    <td><?= number_format($o->total, 2, ",", "."); ?></td>
                    <td>
                        <a style="text-decoration: none" href="#"
                           class="print radius_50 btn_rounded btn-small btn-gray icon-pencil icon-notext"></a>

                        <a style="text-decoration: none" href="#"
                            data-action = "<?= url("/pdf")?>"
                            data-id="<?= $o->id; ?>"
                            class="signer radius_50 btn_rounded btn-small btn-blue icon-plus icon-notext" target="_blank"></a>

                        <a style="text-decoration: none" target="_blank" href="<?= url("/pdf/{$o->id}")?>"
                           class="radius_50 btn_rounded btn-small btn-gray icon-print icon-notext"></a>
                           
                        <a data-remove="<?= url("/remover-notas/{$o->id}") ?>"
                           style="text-decoration: none;"
                           href="#"
                           class="btn-red radius_60 btn_rounded btn-small icon-trash icon-notext"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <th>Nº</th>
            <th>Client Source</th>
            <th>Client Destiny</th>
            <th>Date</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

<?php $v->start("scripts"); ?>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.material.min.js"></script>

<script>
    $(document).ready(function () {
        $('#table').DataTable({
            autoWidth: false,
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'mdc-data-table__cell'
                }
            ]
        });
    });
</script>

<script>

    $(".signer").click(function(){
        var url = $(this).attr("data-action");
        var id = $(this).attr("data-id");
        url = url + "/" +id;

        var load = $(".ajax_load");
        load.fadeIn(200).css("display", "flex");
        gerar(url);
    });


    function gerar(url){
            // https://stackoverflow.com/questions/25751017/how-to-load-a-pdf-into-a-blob-so-it-can-be-uploaded
            var action = "<?= url(); ?>/signer";
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    fileOfBlob = this.response;
                    blobToDataURL(fileOfBlob, function(pdf){
                        $.ajax({
                            url: action,
                            data: {pdf : pdf},
                            type: "POST",
                            crossDomain: true,
                            async: false,
                            dataType: "json",
                            success: function(response){
                                window.location.href = response.redirect;
                            }
                        })
                    });
                };
            }
            xhr.open('GET', url);
            xhr.responseType = 'blob';
            xhr.send();  
        }
        // https://stackoverflow.com/questions/23150333/html5-javascript-dataurl-to-blob-blob-to-dataurl
        //**blob to dataURL**
        function blobToDataURL(blob, callback) {
            var a = new FileReader();
            a.onload = function(e) {callback(e.target.result);}
            a.readAsDataURL(blob);
        }
</script>
<?php $v->end("scripts"); ?>






