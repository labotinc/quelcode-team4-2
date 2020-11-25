<?= $this->Html->css('moviesinfo.css'); ?>
<div class="list-wrap">
    <div class="price-list">
        <p class="title">基本料金</p>
        <table>
            <tbody>
                <?php foreach ($arrayPrices as $price) : ?>
                    <tr class="list-flex">
                        <td><?= h($price->name) ?></td>
                        <td><?= h($price->price) ?> 円</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="discount-list">
        <p class="title">お得な割引サービス</p>
        <table>
            <tbody>
                <?php foreach ($arrayDiscount as $discount) : ?>
                    <tr class="list-flex">
                        <td><?= h($discount->name) ?></td>
                        <td><?= h($discount->price) ?> 円</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
