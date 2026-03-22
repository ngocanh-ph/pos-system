<style>
    :root {
        --pm-bg: #F0F8FF;         
        --pm-navy: #011628;       
        --pm-blue: #044377;       
        --pm-blue-light: #B0DAFD; 
        --pm-white: #FFFFFF;      
        
        --pm-radius-3xl: 3rem;    
        --pm-radius-2xl: 2rem;    
        --pm-radius-xl: 1.5rem;   
        
        --pm-shadow: 0 4px 10px -1px rgba(0, 0, 0, 0.1);
    }

    .product-wrapper {
        background-color: var(--pm-bg);
        font-family: 'Inter', sans-serif;
        color: var(--pm-navy);
        padding: 0.5rem;
    }

    .pm-header {
        display: flex; 
        justify-content: space-between; 
        align-items: flex-end;
        margin-bottom: 1rem; 
        padding: 0 0.5rem;
    }
    .pm-title {
        font-size: 1.5rem; 
        font-weight: 800; 
        color: var(--pm-navy);
        line-height: 1.2; 
        letter-spacing: -0.02em;
    }
    .pm-subtitle { 
        font-size: 0.8rem; 
        color: #64748b; 
        font-weight: 500; 
    }
    
    .btn-add-new {
        background-color: var(--pm-blue); 
        color: white;
        padding: 0.5rem 1.25rem; 
        border-radius: var(--pm-radius-xl);
        font-size: 0.875rem; 
        font-weight: 600; 
        display: flex; 
        align-items: center; 
        gap: 6px;
        box-shadow: 0 4px 6px -1px #04437733;
        transition: all 0.2s ease; 
        text-decoration: none; 
        border: none;
    }
    .btn-add-new:hover { 
        background-color: #033055; 
        transform: translateY(-1px); 
        box-shadow: 0 6px 10px -2px #0443774d; 
        color: white;
    }

    .pm-toolbar {
        background: var(--pm-white);
        border-radius: var(--pm-radius-2xl); 
        padding: 0.5rem 1rem; 
        display: flex; 
        gap: 0.75rem; 
        align-items: center;
        box-shadow: 0 1px 3px #0000001a;
        margin-bottom: 1rem;
    }
    .search-box { 
        flex-grow: 1; 
        position: relative; 
    }
    .search-input {
        width: 100%; 
        background: #F8FAFC; 
        border: 1px solid #e2e8f0;
        border-radius: var(--pm-radius-xl); 
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        font-size: 0.875rem; 
        font-weight: 500; 
        color: var(--pm-navy); 
        transition: 0.2s;
    }
    .search-input:focus { 
        background: white; 
        border-color: var(--pm-blue); 
        outline: none; 
        box-shadow: 0 0 0 3px #508aba1a;
    }
    .search-icon {
        position: absolute; 
        left: 1rem; 
        top: 50%; 
        transform: translateY(-50%);
        color: #94a3b8; 
        font-size: 0.875rem;
    }
    .filter-select {
        background: #F8FAFC; 
        border: 1px solid #e2e8f0;
        padding: 0.5rem 2rem 0.5rem 1rem;
        border-radius: var(--pm-radius-xl); 
        font-size: 0.875rem; 
        font-weight: 600; 
        color: var(--pm-navy);
        outline: none;
    }
    .view-toggles {
        background: #F1F5F9;
        padding: 3px; 
        border-radius: 1rem; 
        display: flex; 
        gap: 2px;
    }
    .view-btn {
        width: 30px; 
        height: 30px; 
        border-radius: 0.8rem; 
        border: none;
        display: flex; 
        align-items: center; 
        justify-content: center;
        color: #64748b; 
        background: transparent; 
        transition: 0.2s;
    }
    .view-btn i { 
        font-size: 0.8rem; 
    }
    .view-btn.active { 
        background: white; 
        color: var(--pm-navy); 
        box-shadow: 0 1px 2px #0000001a; 
    }

    .pm-container {
        background: var(--pm-white);
        border-radius: var(--pm-radius-3xl); 
        padding: 0; 
        overflow: hidden;
        box-shadow: var(--pm-shadow);
        min-height: 600px; 
    }

    .pm-table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0; }
    .pm-table th {
        background: rgba(240, 248, 255, 0.5);
        padding: 0.85rem 1.5rem; 
        font-size: 0.7rem; 
        font-weight: 800; 
        text-transform: uppercase;
        letter-spacing: 0.05em; 
        color: #64748b; 
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    .pm-table td {
        padding: 0.75rem 1.5rem; 
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle; 
        transition: background 0.2s;
    }
    .pm-table tr:hover td { 
        background-color: #F8FAFC; 
    }
    
    .product-name { 
        font-weight: 600; 
        color: var(--pm-navy); 
        font-size: 0.9rem; 
        display: block; 
    }
    .barcode-text { 
        font-family: 'Courier New', monospace; 
        color: #64748b; 
        font-size: 0.75rem; 
    }
    .badge-cat { 
        background: #e0e7ff; 
        color: #4338ca; 
        padding: 4px 12px; 
        border-radius: 20px; 
        font-size: 0.75rem; 
        font-weight: 700; 
        display: inline-block;
        white-space: nowrap; /* BẮT BUỘC CÓ: Chống rớt dòng chữ */
    }
    .price-text { 
        font-family: 'Inter', sans-serif; 
        font-weight: 700; 
        color: var(--pm-blue); 
        font-size: 0.95rem; 
    }
    .grid-container {
        display: none;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
    .product-card {
        background: white; 
        border-radius: var(--pm-radius-2xl); 
        border: 1px solid #e2e8f0; 
        padding: 1rem; 
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex; 
        flex-direction: column; 
        height: 100%;
    }
    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: var(--pm-blue-light);
    }
    .card-img-box {
        width: 100%; 
        aspect-ratio: 1; 
        background: #F8FAFC;
        border-radius: 1.5rem; 
        margin-bottom: 0.75rem;
        display: flex; 
        align-items: center; 
        justify-content: center;
        overflow: hidden;
    }
    .card-img-box img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
    }
    .card-actions { 
        position: absolute; top: 1rem; right: 1rem; 
        opacity: 1; 
        z-index: 2;
    }
    
    .card-price { 
        margin-top: auto; 
        padding-top: 0.5rem;
        font-size: 1.1rem; 
        font-weight: 700; 
        color: var(--pm-navy); 
    }
    .row-actions { 
        display: flex; 
        gap: 6px; 
        justify-content: flex-end;
        opacity: 1; 
    }
    
    .btn-icon { 
        width: 30px; 
        height: 30px; 
        border-radius: 50%; 
        border: none; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        transition: 0.2s; 
    }
    .btn-edit { 
        background: #e0f2fe; 
        color: #0284c7; } 
    .btn-edit:hover { 
        background: #0284c7; 
        color: white; }
    .btn-delete { 
        background: #fee2e2; 
        color: #dc2626; 
    } 
    .btn-delete:hover { 
        background: #dc2626; 
        color: white; 
    }
    .empty-state {
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center;
        color: #94a3b8; 
        height: 100%; 
        width: 100%;
    }
    .form-label-caps {
        font-size: 0.7rem; 
        font-weight: 700; 
        text-transform: uppercase;
        letter-spacing: 0.05em; 
        color: #64748b; 
        margin-bottom: 0.25rem; 
        display: block;
    }
    .form-input-lg {
        width: 100%; 
        padding: 0.6rem 1rem; 
        border-radius: var(--pm-radius-xl);
        background: #F8FAFC; 
        border: 1px solid #e2e8f0;
        font-weight: 500; 
        font-size: 0.9rem; 
        color: var(--pm-navy);
    }
    .form-input-lg:focus { 
        outline: none; 
        border-color: var(--pm-blue); 
        background: white; 
    }
    .product-avatar-text{
        width:36px;
        height:36px;
        border-radius:50%;
        background:#E2E8F0;
        color:#334155;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:800;
        font-size:0.85rem;
        text-transform:uppercase;
    }
    .fade-in { 
        animation: fadeIn 0.3s ease-out; 
    }
    @keyframes fadeIn { from { 
        opacity: 0; 
        transform: translateY(5px); 
        } to {
        opacity: 1; 
        transform: translateY(0); 
        } 
    }
</style>

<div class="product-wrapper">
    <div class="pm-header">
        <div>
            <div class="pm-title">Quản lý sản phẩm</div>
            <div class="pm-subtitle">Danh sách & Quản lý kho hàng</div>
        </div>
        
        <?php if($_SESSION['user']->role === 'admin'): ?>
        <button type="button" class="btn-add-new" onclick="openAddModal()">
            <i class="fas fa-plus" style="font-size: 0.8rem"></i> Thêm mới
        </button>
        <?php endif; ?>
    </div>

    <div class="pm-toolbar">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm tên, mã vạch...">
        </div>
        
        <select id="categoryFilter" class="filter-select">
            <option value="">Tất cả danh mục</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat->id ?>"><?= htmlspecialchars($cat->name) ?></option>
            <?php endforeach; ?>
        </select>

        <div class="view-toggles">
            <button class="view-btn active" id="btnList" onclick="switchView('list')"><i class="fas fa-list"></i></button>
            <button class="view-btn" id="btnGrid" onclick="switchView('grid')"><i class="fas fa-th-large"></i></button>
        </div>
    </div>

    <?php if(empty($products)): ?>
        <div class="pm-container d-flex align-items-center justify-content-center">
            <div class="empty-state">
                <i class="fas fa-box-open" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                <div style="font-weight: 600; font-size: 1.1rem;">Chưa có sản phẩm nào.</div>
            </div>
        </div>
    <?php else: ?>
        <div id="listView" class="pm-container">
            <div class="table-responsive">
                <table class="pm-table">
                    <thead>
                        <tr>
                            <th width="50">Ảnh</th>
                            <th>Thông tin sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Ngày tạo</th>
                            <?php if($_SESSION['user']->role === 'admin'): ?><th>Giá nhập</th><?php endif; ?>
                            <th>Giá bán</th>
                            <?php if($_SESSION['user']->role === 'admin'): ?>
                                <th width="100" style="text-align: right;">Thao tác</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php foreach ($products as $p): ?>
                        <tr class="product-row" data-name="<?= strtolower($p->name) ?>" data-barcode="<?= $p->barcode ?>" data-cat="<?= $p->category_id ?>">
                            <td>
                               <?php
                               $productName = trim($p->name);
                               $firstLetter = mb_strtoupper(mb_substr($productName,0,1,'UTF-8'),'UTF-8');
                               $hasImage = !empty($p->image) && $p->image !== 'default_product.png';
                               ?>
                               <?php if($hasImage): ?>
                                <img src="<?= APP_URL ?>/uploads/<?= $p->image ?>"  width="36" height="36" class="rounded-circle" style="object-fit:cover" onerror="this.outerHTML='<div class=\'product-avatar-text\'><?= $firstLetter ?></div>'">
                                <?php else: ?>
                                    <div class="product-avatar-text"><?= $firstLetter ?></div>
                                <?php endif; ?>
                            </td> <td>
                                <span class="product-name"><?= htmlspecialchars($p->name) ?></span>
                                <span class="barcode-text"><?= htmlspecialchars($p->barcode) ?></span>
                            </td>
                            <td>
                                <span class="badge-cat"><?= htmlspecialchars($p->category_name ?? 'N/A') ?></span>
                            </td>
                            <td>
                                <span style="color:#64748b; font-size: 0.85rem">
                                    <?= !empty($p->created_at) ? date('d/m/Y', strtotime($p->created_at)) : 'N/A' ?>
                                </span>
                            </td>
                            <?php if($_SESSION['user']->role === 'admin'): ?>
                            <td>
                                <span class="price-text" style="color:#64748b"><?= number_format($p->import_price) ?></span>
                            </td>
                            <?php endif; ?>
                            <td>
                                <span class="price-text"><?= number_format($p->sale_price) ?></span>
                            </td>
                            <?php if($_SESSION['user']->role === 'admin'): ?>
                            <td>
                                <div class="row-actions">
                                    <button class="btn-icon btn-edit" onclick='openEditModal(<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)'>
                                        <i class="fas fa-pen" style="font-size: 0.75rem"></i>
                                    </button>
                                    <button class="btn-icon btn-delete" onclick="deleteProduct(<?= $p->id ?>)">
                                        <i class="fas fa-trash" style="font-size: 0.75rem"></i>
                                    </button>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="gridView" class="grid-container">
            <?php foreach ($products as $p): ?>
            <div class="product-card product-row" data-name="<?= strtolower($p->name) ?>" data-barcode="<?= $p->barcode ?>" data-cat="<?= $p->category_id ?>">
                <div class="card-img-box">
                    <?php 
                        $productName = trim($p->name);
                        $firstLetter = mb_strtoupper(mb_substr($productName,0,1,'UTF-8'),'UTF-8');
                        $hasImage = !empty($p->image) && $p->image !== 'default_product.png';
                    ?>
                    <?php if($hasImage): ?>
                    <img src="<?= APP_URL ?>/uploads/<?= $p->image ?>">
                    <?php else: ?>
                    <div class="product-avatar-text" style="width:100%;height:100%;border-radius:1.5rem;font-size:2rem;">
                        <?= $firstLetter ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <h5 style="font-weight: 600; color: var(--pm-navy); margin-bottom: 0.2rem; font-size:0.95rem">
                    <?= htmlspecialchars($p->name) ?>
                </h5>
                <div class="d-flex justify-content-between align-items-center mb-1">
                     <span style="font-size: 0.75rem; color:#94a3b8"><?= htmlspecialchars($p->barcode) ?></span>
                     <span style="font-size: 0.7rem; color:#cbd5e1">
                        <?= !empty($p->created_at) ? date('d/m/y', strtotime($p->created_at)) : '' ?>
                     </span>
                </div>
                
                <?php if($_SESSION['user']->role === 'admin'): ?>
                <div style="font-size:0.75rem; color:#94a3b8; margin-top:0.25rem">Nhập: <?= number_format($p->import_price) ?></div>
                <?php endif; ?>
                <div class="card-price"><?= number_format($p->sale_price) ?></div>

                <?php if($_SESSION['user']->role === 'admin'): ?>
                <div class="card-actions d-flex gap-2">
                    <button class="btn-icon btn-edit shadow-sm" style="background:white" onclick='openEditModal(<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)'>
                        <i class="fas fa-pen" style="font-size: 0.75rem"></i>
                    </button>
                    <button class="btn-icon btn-delete shadow-sm" onclick="deleteProduct(<?= $p->id ?>)">
                        <i class="fas fa-trash" style="font-size: 0.75rem"></i>
                    </button>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="modal fade modal-custom" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 2rem; border:none; padding: 0.5rem;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Thêm sản phẩm mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="p_id">
                    
                    <div class="mb-3">
                        <label class="form-label-caps">Mã vạch (Barcode)</label>
                        <input type="text" class="form-input-lg" name="barcode" id="p_barcode" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-caps">Tên sản phẩm</label>
                        <input type="text" class="form-input-lg" name="name" id="p_name" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <?php if($_SESSION['user']->role === 'admin'): ?>
                        <div class="col-6">
                            <label class="form-label-caps">Giá nhập</label>
                            <input type="number" class="form-input-lg" name="import_price" id="p_import" required>
                        </div>
                        <?php endif; ?>
                        
                        <div class="<?php echo ($_SESSION['user']->role === 'admin') ? 'col-6' : 'col-12'; ?>">
                            <label class="form-label-caps">Giá bán</label>
                            <input type="number" class="form-input-lg" name="sale_price" id="p_sale" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-caps">Danh mục</label>
                        <select class="form-input-lg" name="category_id" id="p_category" style="appearance: auto;">
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat->id ?>"><?= htmlspecialchars($cat->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label-caps">Hình ảnh</label>
                        <input type="file" class="form-control form-control-sm" name="image" accept="image/*">
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="button" class="btn btn-light btn-sm flex-grow-1 rounded-pill fw-bold py-2" data-bs-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary btn-sm flex-grow-1 rounded-pill fw-bold py-2" style="background: var(--pm-navy); border:none">
                            Hoàn tất
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1060;">
    <div id="actionToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage" style="font-weight: 500; font-size: 0.95rem;">
                Thành công!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= APP_URL ?>";
    let modal; 
    let isEdit = false;

    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('productModal');
        if (modalEl) {
            modal = new bootstrap.Modal(modalEl);
        }

        $('#searchInput').on('keyup', filterProducts);
        $('#categoryFilter').on('change', filterProducts);

        $('#productForm').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const endpoint = isEdit ? '/products/update' : '/products/store';
            
            $.ajax({
                url: BASE_URL + endpoint,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    const toastEl = document.getElementById('actionToast');
                    const toast = new bootstrap.Toast(toastEl, { delay: 2500 }); 
                
                    if(res.success) {
                        $('#actionToast').removeClass('bg-danger').addClass('bg-success');
                        $('#toastMessage').text(isEdit ? 'Cập nhật thành công!' : 'Thêm mới thành công!');
                        modal.hide(); 
                        toast.show(); 
                        $.get(location.href, function(newData) {
                            let parsedDOM = $('<div/>').append(newData);
                            let newTableContent = parsedDOM.find('.product-wrapper .pm-toolbar').nextAll();
                            
                            $('.pm-toolbar').nextAll().remove();
                            $('.pm-toolbar').after(newTableContent);
                        
                            if ($('#btnGrid').hasClass('active')) {
                                $('#listView').hide();
                                $('#gridView').css('display', 'grid').addClass('fade-in');
                            } else {
                                $('#gridView').hide();
                                $('#listView').show().addClass('fade-in');
                            }
                        });

                    } else { 
                        $('#actionToast').removeClass('bg-success').addClass('bg-danger');
                        $('#toastMessage').text('Lỗi: ' + (res.message || 'Không thể lưu sản phẩm!'));
                        toast.show();
                    }
                },
                error: function(xhr) {
                    const toastEl = document.getElementById('actionToast');
                    $('#actionToast').removeClass('bg-success').addClass('bg-danger');
                    $('#toastMessage').text('Lỗi hệ thống: ' + xhr.statusText);
                    new bootstrap.Toast(toastEl).show();
                }
            });
        });
    });

    window.switchView = function(mode) {
        if(mode === 'list') {
            $('#listView').show().addClass('fade-in');
            $('#gridView').hide();
            $('#btnList').addClass('active');
            $('#btnGrid').removeClass('active');
        } else {
            $('#listView').hide();
            $('#gridView').css('display', 'grid').addClass('fade-in');
            $('#btnList').removeClass('active');
            $('#btnGrid').addClass('active');
        }
    }

    function filterProducts() {
        const term = $('#searchInput').val().toLowerCase();
        const cat = $('#categoryFilter').val();

        $('.product-row').each(function() {
            const name = $(this).data('name').toString();
            const barcode = $(this).data('barcode').toString();
            const pCat = ($(this).data('cat') || "").toString();
            
            const matchSearch = name.includes(term) || barcode.includes(term);
            const matchCat = cat === "" || pCat === cat;

            if (matchSearch && matchCat) $(this).show();
            else $(this).hide();
        });
    }

    window.openAddModal = function() {
        isEdit = false;
        $('#modalTitle').text('Thêm sản phẩm mới');
        $('#productForm')[0].reset();
        $('#p_id').val('');
        if(modal) modal.show();
    }

    window.openEditModal = function(product) {
        isEdit = true;
        $('#modalTitle').text('Cập nhật sản phẩm');
        $('#p_id').val(product.id);
        $('#p_barcode').val(product.barcode);
        $('#p_name').val(product.name);
        
        if($('#p_import').length) {
            $('#p_import').val(product.import_price);
        }
        
        $('#p_sale').val(product.sale_price);
        $('#p_category').val(product.category_id);
        if(modal) modal.show();
    }

    window.deleteProduct = function(id) {
        $.post(BASE_URL + '/products/delete', {id: id}, function(res) {
            const toastEl = document.getElementById('actionToast');
            const toast = new bootstrap.Toast(toastEl, { delay: 2500 }); 

            if(res.success) {
                $('#actionToast').removeClass('bg-danger').addClass('bg-success');
                $('#toastMessage').text('Xóa sản phẩm thành công!');
                toast.show();
                $('button[onclick="deleteProduct(' + id + ')"]').closest('.product-row').fadeOut(300, function() {
                    $(this).remove(); 
                });
            } else {
                $('#actionToast').removeClass('bg-success').addClass('bg-danger');
                $('#toastMessage').text('Lỗi: ' + (res.message || 'Không thể xóa sản phẩm!'));
                toast.show();
            }
        }, 'json').fail(function() {
            const toastEl = document.getElementById('actionToast');
            $('#actionToast').removeClass('bg-success').addClass('bg-danger');
            $('#toastMessage').text('Lỗi kết nối Server!');
            new bootstrap.Toast(toastEl).show();
        });
    }
</script>