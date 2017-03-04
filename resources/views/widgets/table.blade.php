<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> <?= $class . " List"; ?>
        </div>
        <div class="card-block">
            <table class="table table-small">
                <thead>
                    <tr>
                        <?php foreach ($thead as $key => $value) : ?>
                            <th><?= $value; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($tdata as $tkey => $tvalue) :?>
                            <?php foreach ($tvalue as $ikey => $ivalue) : ?>
                                <th><?= $ivalue; ?></th>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>