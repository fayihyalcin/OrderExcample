<?= $this->extend('layout/main') ?>


<?= $this->section('content') ?>
    <div class="container mt-5">
        <h1>Sepet Listesi</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>Ürün Adı</th>
            <th>Ürün Açıklaması</th>
            <th>Ürün Fiyatı</th>
            <th>Miktar</th>
            <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($cartItems as $item): ?>
            <?php $product = $productModel->find($item['product_id']); ?>
            <tr>
                <td><?= esc($product['name']) ?></td>
                <td><?= esc($product['description']) ?></td>
                <td><?= esc($product['price']) ?> TL</td>
                <td><?= esc($item['quantity']) ?></td>
                <td>
                    <form action="<?= base_url('cart/remove/' . $item['id']) ?>" method="post">
                        <button type="submit" class="btn btn-danger btn-sm">Sepetten Sil</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>


