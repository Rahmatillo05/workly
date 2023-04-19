<?php

/**
 * @var \app\models\LoginHistory $history
 */

use app\components\tools\StatusSetter;
$this->title = "Login history"
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Login History</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Device</th>
                        <th>Location</th>
                        <th>IP</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                    <?php $i = 0; foreach ($history as $item) :  ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $item->device ?></td>
                            <td><?= $item->location ?></td>
                            <td><?= $item->ip ?></td>
                            <td><?= StatusSetter::statusSet($item->status) ?></td>
                            <td><?= date('d-M-Y H:i', $item->created_at)?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>