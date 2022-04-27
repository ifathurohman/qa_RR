<html>

<head>
    <title>
        <?= $title ?>
    </title>
</head>

<body>
    <div id="print-page" style="margin-top:10px">
        <table style="margin-top:0px;border:none;width: 100%">
            <tr>
                <td class="td-title text-center" colspan="3"><b>Broadcast Email </b></td>
            </tr>
            <?php if($modul == "view"): ?>
                <tr>
                    <td style="width: 20%">Subject</td>
                    <td width="10px"> : </td>
                    <td><?= $list->EmailSubject ?></td>
                </tr>
                <tr>
                    <td style="width: 20%">Pengirim</td>
                    <td width="10px"> : </td>
                    <td><?= $list->userName ?></td>
                </tr>
                <tr>
                    <td style="width: 20%">Kepada</td>
                    <td width="10px"> : </td>
                    <td>
                        <?php foreach ($email as $k => $v) {
                            echo $v;
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">Sebagai</td>
                    <td width="10px"> : </td>
                    <td><?= $this->main->label_type_broadcast($list->Type, "cetak") ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center">
                        <?= $list->EmailContent ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr class="border">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
                <?php $no = 1;
                $sendTo         = json_decode($list->EmailTo);
                foreach ($sendTo as $d) {
                    $ID         = $d->ID;
                    $status     = $d->status;
                    if($list->Type == 1):
                        $marketing  = $this->api->marketing_detail($ID);
                    elseif($list->Type == 2 || $list->Type == 3):
                        $marketing  = $this->api->vendor_detail($ID);
                    elseif($list->Type == 4):
                        $marketing  = $this->api->user_detail("",$ID);
                    endif;
                    if($list->Type != 5):
                        $Name = $marketing->Name." (".$marketing->Email.")";
                    else:
                        $Name = $ID;
                    endif;
                    ?>
                    <tr class="border">
                        <td><?= $no++ ?></td>
                        <td><?= $Name ?></td>
                        <td><?= $this->main->label_status_broadcast($status, "cetak") ?></td>
                    </tr>

                <?php }
             ?>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>