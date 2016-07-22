<div class="panel with-nav-tabs panel-default">
    <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_transactions_<?= $recipient_id ?>" data-toggle="tab">Transactions</a></li>
            <li><a href="#tab_charts_<?= $recipient_id ?>" data-toggle="tab">Visual Breakdown</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_transactions_<?= $recipient_id ?>">
                <div class="table-responsive">
                    <table id="transactions_table_<?= $recipient_id ?>" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nature of Payment</th>
                                <?php if ($recipient_type == \App\Models\Recipient::HOSPITAL): ?>
                                    <th>Paid To</th>
                                <?php else: ?>
                                    <th>Paid By</th>
                                <?php endif; ?>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php ?>
                            <?php foreach ($transactions as $transaction): ?>
                                <?php if ($recipient_type == \App\Models\Recipient::HOSPITAL): ?>
                                    <tr>
                                        <td><?= $transaction->nature_of_payment_or_transfer_of_value . ((property_exists($transaction, "contextual_information")) ? " ({$transaction->contextual_information})" : "") ?></td>
                                        <td><?= $transaction->applicable_manufacturer_or_applicable_gpo_making_payment_name ?></td>
                                        <td><?= date('m/d/y', strtotime($transaction->date_of_payment)) ?></td>
                                        <td><?= money_format('$%.2n', $transaction->total_amount_of_payment_usdollars) ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td><?= $transaction->nature_of_payment_or_transfer_of_value ?></td>
                                        <td><?= $transaction->applicable_manufacturer_or_applicable_gpo_making_payment_name ?></td>
                                        <td><?= date('m/d/y', strtotime($transaction->date_of_payment)) ?></td>
                                        <td><?= money_format('$%.2n', $transaction->total_amount_of_payment_usdollars) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_charts_<?= $recipient_id ?>">
                <input type="hidden"id="charts_data_<?= $recipient_id ?>" value='<?= $chartData; ?>'>
                <div id="chart_container_<?= $recipient_id ?>" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

