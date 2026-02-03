<style>
    /* --- DESIGN SYSTEM: PRODUCT MANAGER (COMPACT BUT ROUNDED) --- */
    :root {
        --pm-bg: #F0F8FF;         
        --pm-navy: #011628;       
        --pm-blue: #044377;       
        --pm-blue-light: #B0DAFD; 
        --pm-white: #FFFFFF;      
        
        /* KHÔI PHỤC: Giữ nguyên bo góc lớn như bản gốc */
        --pm-radius-3xl: 3rem;    /* 48px - Rất tròn */
        --pm-radius-2xl: 2rem;    /* 32px */
        --pm-radius-xl: 1.5rem;   /* 24px - Dạng viên thuốc */
        
        /* Giữ shadow nhẹ gọn để đỡ nặng nề khi thu nhỏ */
        --pm-shadow: 0 4px 10px -1px rgba(0, 0, 0, 0.1);
    }

    /* Reset & Base */
    .product-wrapper {
        background-color: var(--pm-bg);
        font-family: 'Inter', sans-serif;
        color: var(--pm-navy);
        padding: 0.5rem; /* Compact wrapper */
    }

    /* 1. Header & Action Bar */
    .pm-header {
        display: flex; justify-content: space-between; align-items: flex-end;
        margin-bottom: 1rem; /* Compact margin */
        padding: 0 0.5rem;
    }
    .pm-title {
        font-size: 1.5rem; /* Compact Font */
        font-weight: 800; color: var(--pm-navy);
        line-height: 1.2; letter-spacing: -0.02em;
    }
    .pm-subtitle { font-size: 0.8rem; color: #64748b; font-weight: 500; }
    
    .btn-add-new {
        background-color: var(--pm-blue); color: white;
        padding: 0.5rem 1.25rem; /* Padding nhỏ nhưng vẫn giữ dáng pill */
        border-radius: var(--pm-radius-xl); /* KHÔI PHỤC BO GÓC */
        font-size: 0.875rem; 
        font-weight: 600; display: flex; align-items: center; gap: 6px;
        box-shadow: 0 4px 6px -1px rgba(4, 67, 119, 0.2);
        transition: all 0.2s ease; text-decoration: none; border: none;
    }
    .btn-add-new:hover { 
        background-color: #033055; transform: translateY(-1px); 
        box-shadow: 0 6px 10px -2px rgba(4, 67, 119, 0.3); color: white;
    }

    /* 2. Smart Toolbar */
    .pm-toolbar {
        background: var(--pm-white);
        border-radius: var(--pm-radius-2xl); /* KHÔI PHỤC BO GÓC LỚN (32px) */
        padding: 0.5rem 1rem; /* Compact padding bên trong */
        display: flex; gap: 0.75rem; align-items: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 1rem;
    }
    
    .search-box {
        flex-grow: 1; position: relative;
    }
    .search-input {
        width: 100%; background: #F8FAFC; border: 1px solid #e2e8f0;
        border-radius: var(--pm-radius-xl); /* KHÔI PHỤC BO GÓC (24px) */
        padding: 0.5rem 0.75rem 0.5rem 2.5rem; /* Compact padding */
        font-size: 0.875rem;
        font-weight: 500; color: var(--pm-navy); transition: 0.2s;
    }
    .search-input:focus { background: white; border-color: var(--pm-blue); outline: none; }
    .search-icon {
        position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
        color: #94a3b8; font-size: 0.875rem;
    }

    .filter-select {
        background: #F8FAFC; border: 1px solid #e2e8f0;
        padding: 0.5rem 2rem 0.5rem 1rem;
        border-radius: var(--pm-radius-xl); /* KHÔI PHỤC BO GÓC */
        font-size: 0.875rem; 
        font-weight: 600; color: var(--pm-navy);
        cursor: pointer; outline: none;
    }

    .view-toggles {
        background: #F1F5F9; padding: 3px; 
        border-radius: 1rem; /* Bo góc toggle vẫn giữ tròn */
        display: flex; gap: 2px;
    }
    .view-btn {
        width: 30px; height: 30px; 
        border-radius: 0.8rem; /* Bo góc nút con */
        border: none;
        display: flex; align-items: center; justify-content: center;
        color: #64748b; background: transparent; transition: 0.2s;
    }
    .view-btn i { font-size: 0.8rem; }
    .view-btn.active { background: white; color: var(--pm-navy); box-shadow: 0 1px 2px rgba(0,0,0,0.1); }

    /* 3. High Density Table (List View) */
    .pm-container {
        background: var(--pm-white);
        border-radius: var(--pm-radius-3xl); /* KHÔI PHỤC BO GÓC LỚN (48px) */
        padding: 0; overflow: hidden;
        box-shadow: var(--pm-shadow);
        min-height: 500px;
    }

    .pm-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .pm-table th {
        background: rgba(240, 248, 255, 0.5);
        padding: 0.85rem 1.5rem; /* Compact padding */
        font-size: 0.7rem; 
        font-weight: 800; text-transform: uppercase;
        letter-spacing: 0.05em; color: #64748b; text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    .pm-table td {
        padding: 0.75rem 1.5rem; /* Compact padding */
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle; transition: background 0.2s;
    }
    .pm-table tr:hover td { background-color: #F8FAFC; }
    
    .product-name { font-weight: 600; color: var(--pm-navy); font-size: 0.9rem; display: block; }
    .barcode-text { font-family: 'Courier New', monospace; color: #64748b; font-size: 0.75rem; }
    
    .badge-cat {
        background: #e0e7ff; color: #4338ca; 
        padding: 3px 10px; border-radius: 20px; /* Badge vẫn rất tròn */
        font-size: 0.7rem; font-weight: 700;
    }
    
    .price-text { font-family: 'Inter', sans-serif; font-weight: 700; color: var(--pm-blue); font-size: 0.95rem; }

    /* Action Buttons */
    .row-actions { opacity: 0; transition: opacity 0.2s; display: flex; gap: 6px; justify-content: flex-end; }
    .pm-table tr:hover .row-actions { opacity: 1; }
    
    .btn-icon {
        width: 30px; height: 30px; 
        border-radius: 50%; /* KHÔI PHỤC: Hình tròn hoàn hảo */
        border: none;
        display: flex; align-items: center; justify-content: center;
        transition: 0.2s; cursor: pointer;
    }
    .btn-edit { background: #e0f2fe; color: #0284c7; }
    .btn-edit:hover { background: #0284c7; color: white; }
    .btn-delete { background: #fee2e2; color: #dc2626; }
    .btn-delete:hover { background: #dc2626; color: white; }

    /* 4. Grid Mode (Gallery) */
    .grid-container {
        display: none;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .product-card {
        background: white; 
        border-radius: var(--pm-radius-2xl); /* KHÔI PHỤC BO GÓC LỚN (32px) */
        border: 1px solid #e2e8f0; 
        padding: 1rem; position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: var(--pm-blue-light);
    }

    .card-img-box {
        width: 100%; aspect-ratio: 1; background: #F8FAFC;
        border-radius: 1.5rem; /* Bo góc ảnh trong card cũng lớn */
        margin-bottom: 0.75rem;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden;
    }
    .card-img-box img { width: 100%; height: 100%; object-fit: cover; }
    
    .card-actions {
        position: absolute; top: 1rem; right: 1rem;
        opacity: 0; transition: 0.2s;
    }
    .product-card:hover .card-actions { opacity: 1; }

    .card-price {
        position: absolute; bottom: 1rem; left: 1rem;
        font-size: 1rem; font-weight: 700; color: var(--pm-navy);
    }

    /* 5. Modal Design */
    .modal-custom .modal-content {
        border-radius: var(--pm-radius-3xl); /* KHÔI PHỤC BO GÓC MODAL LỚN */
        border: none;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        padding: 0.5rem; /* Viền modal */
    }
    .modal-backdrop.show { backdrop-filter: blur(2px); opacity: 0.5; }
    
    .modal-header { border-bottom: 1px solid #f1f5f9; padding: 1rem 1.5rem; }
    .modal-body { padding: 1.5rem; }
    .modal-title { font-weight: 700; color: var(--pm-navy); font-size: 1.25rem; }
    
    .form-label-caps {
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.05em; color: #64748b; margin-bottom: 0.25rem; display: block;
    }
    .form-input-lg {
        width: 100%; padding: 0.6rem 1rem;
        border-radius: var(--pm-radius-xl); /* KHÔI PHỤC BO GÓC INPUT (24px) */
        background: #F8FAFC; border: 1px solid #e2e8f0;
        font-weight: 500; font-size: 0.9rem; color: var(--pm-navy);
    }
    .form-input-lg:focus { outline: none; border-color: var(--pm-blue); background: white; }

    /* Transitions */
    .fade-in { animation: fadeIn 0.3s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

    /* Responsive */
    @media (max-width: 768px) {
        .pm-header { flex-direction: column; align-items: flex-start; gap: 0.5rem; }
        .pm-toolbar { flex-wrap: wrap; }
        .search-box { width: 100%; }
        .pm-table th:nth-child(4), .pm-table td:nth-child(4) { display: none; }
    }
</style>

<div class="product-wrapper fade-in">
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

    <div id="listView" class="pm-container">
        <div class="table-responsive">
            <table class="pm-table">
                <thead>
                    <tr>
                        <th width="50">Ảnh</th>
                        <th>Thông tin sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá bán</th>
                        <?php if($_SESSION['user']->role === 'admin'): ?><th width="80"></th><?php endif; ?>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <?php foreach ($products as $p): ?>
                    <tr class="product-row" data-name="<?= strtolower($p->name) ?>" data-barcode="<?= $p->barcode ?>" data-cat="<?= $p->category_id ?>">
                        <td>
                            <img src="<?= APP_URL ?>/uploads/<?= $p->image ? $p->image : 'default_product.png' ?>" 
                                 width="36" height="36" class="rounded-circle" style="object-fit:cover; background:#f1f5f9">
                        </td>
                        <td>
                            <span class="product-name"><?= htmlspecialchars($p->name) ?></span>
                            <span class="barcode-text"><?= htmlspecialchars($p->barcode) ?></span>
                        </td>
                        <td>
                            <span class="badge-cat"><?= htmlspecialchars($p->category_name ?? 'N/A') ?></span>
                        </td>
                        <td>
                            <span class="price-text"><?= number_format($p->sale_price) ?></span>
                        </td>
                        <?php if($_SESSION['user']->role === 'admin'): ?>
                        <td>
                            <div class="row-actions">
                                <button class="btn-icon btn-edit" onclick='openEditModal(<?= json_encode($p) ?>)'>
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
                <img src="<?= APP_URL ?>/uploads/<?= $p->image ? $p->image : 'default_product.png' ?>">
            </div>
            
            <h5 style="font-weight: 600; color: var(--pm-navy); margin-bottom: 0.2rem; font-size:0.95rem">
                <?= htmlspecialchars($p->name) ?>
            </h5>
            <span style="font-size: 0.75rem; color:#94a3b8"><?= htmlspecialchars($p->barcode) ?></span>
            
            <div class="card-price"><?= number_format($p->sale_price) ?></div>

            <?php if($_SESSION['user']->role === 'admin'): ?>
            <div class="card-actions">
                <button class="btn-icon btn-edit shadow-sm" style="background:white" onclick='openEditModal(<?= json_encode($p) ?>)'>
                    <i class="fas fa-pen" style="font-size: 0.75rem"></i>
                </button>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade modal-custom" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
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
                        <div class="col-6">
                            <label class="form-label-caps">Giá nhập</label>
                            <input type="number" class="form-input-lg" name="import_price" id="p_import" required>
                        </div>
                        <div class="col-6">
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

<script>
    // --- 1. View Toggles ---
    function switchView(mode) {
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

    // --- 2. Filter & Search Logic ---
    function filterProducts() {
        const term = $('#searchInput').val().toLowerCase();
        const cat = $('#categoryFilter').val();

        $('.product-row').each(function() {
            const name = $(this).data('name').toString();
            const barcode = $(this).data('barcode').toString();
            const pCat = $(this).data('cat').toString();
            
            const matchSearch = name.includes(term) || barcode.includes(term);
            const matchCat = cat === "" || pCat === cat;

            if (matchSearch && matchCat) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    $('#searchInput').on('keyup', filterProducts);
    $('#categoryFilter').on('change', filterProducts);

    // --- 3. Modal Logic ---
    let isEdit = false;
    const modal = new bootstrap.Modal(document.getElementById('productModal'));

    function openAddModal() {
        isEdit = false;
        $('#modalTitle').text('Thêm sản phẩm mới');
        $('#productForm')[0].reset();
        $('#p_id').val('');
        modal.show();
    }

    function openEditModal(product) {
        isEdit = true;
        $('#modalTitle').text('Cập nhật sản phẩm');
        $('#p_id').val(product.id);
        $('#p_barcode').val(product.barcode);
        $('#p_name').val(product.name);
        $('#p_import').val(product.import_price);
        $('#p_sale').val(product.sale_price);
        $('#p_category').val(product.category_id);
        modal.show();
    }

    // --- 4. AJAX Submission ---
    $('#productForm').submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const url = isEdit ? '/products/update' : '/products/store';

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if(res.success) {
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    // --- 5. Delete Logic ---
    window.deleteProduct = function(id) {
        if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            $.post('/products/delete', {id: id}, function(res) {
                if(res.success) location.reload();
                else alert(res.message);
            }, 'json');
        }
    }
</script>