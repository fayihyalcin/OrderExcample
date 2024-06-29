<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="container mt-5">
        <h1>Yeni Ürün Ekle</h1>
        <form action="<?= base_url('products/store') ?>" method="post">
                    <div class="row">
                    <div class="col-md-3 mb-3">
                            <label for="name" class="form-label">Ürün Adı</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="price" class="form-label">Ürün Fiyatı</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Ürün Açıklaması</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>
                    </div>
         
            <button type="submit" class="btn btn-primary">Ürünü Ekle</button>
        </form>
    </div>
<?= $this->endSection() ?>



<?= $this->section('content') ?>
    <div class="container mt-5">
        <h1>Ürün Listesi</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Ürün Açıklaması</th>
                    <th scope="col">Fiyat</th>
                    <th scope="col">İşlemler</th>
                    <th scope="col">Sepet</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= esc($product['name']) ?></td>
                        <td><?= esc($product['description']) ?></td>
                        <td><?= esc($product['price']) ?> TL</td>
                        <td>
                            <form action="<?= base_url('products/delete/' . $product['id']) ?>" method="post">
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </td>
                        <td>
                    <form action="<?= base_url('cart/add/' . $product['id']) ?>" method="post">
                        <button type="submit" class="btn btn-primary btn-sm">Sepete Ekle</button>
                    </form>
                </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>


