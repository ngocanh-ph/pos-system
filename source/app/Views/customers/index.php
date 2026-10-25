<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h4 class="fw-bold mb-0">Khách hàng</h4>
            <form method="GET" class="d-flex gap-2 m-0" style="max-width: 360px;">
                <input type="search" name="q" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Tìm theo tên hoặc SĐT...">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th class="text-center">Số đơn</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody">
                    <?php if (empty($customers)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Chưa có khách hàng nào.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($customers as $c): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($c->name) ?></td>
                            <td><?= htmlspecialchars($c->phone) ?></td>
                            <td><?= htmlspecialchars($c->address ?? '') ?></td>
                            <td class="text-center"><span class="badge bg-secondary"><?= (int)$c->order_count ?></span></td>
                            <td><?= date('d/m/Y', strtotime($c->created_at)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($totalPages > 1): ?>
            <?php $qs = $search !== '' ? '&q=' . urlencode($search) : ''; ?>
            <nav class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted"><?= (int)$total ?> khách hàng • Trang <?= $page ?>/<?= $totalPages ?></small>
                <ul class="pagination mb-0">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page - 1 . $qs ?>">&laquo;</a></li>
                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 . $qs ?>">&raquo;</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
