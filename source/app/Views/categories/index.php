<style>
    :root {
        --cat-bg: #F0F8FF;        
        --cat-navy: #011628;      
        --cat-indigo: #044377;    
        --cat-accent: #508ABA;    
        --cat-white: #FFFFFF;     
        --cat-radius-3xl: 3rem;    
        --cat-radius-xl: 1.5rem;   
        --cat-radius-lg: 1.25rem;  
        
        --cat-shadow: 0 4px 10px -1px #b0dafd66;
    }

    /* Base Layout */
    .cat-wrapper {
        background-color: var(--cat-bg);
        font-family: 'Inter', sans-serif;
        color: var(--cat-navy);
        padding: 0.5rem; 
        min-height: 85vh;
    }

    /* Header & Action Bar */
    .cat-header {
        display: flex; 
        justify-content: space-between; 
        align-items: flex-end;
        margin-bottom: 1rem; 
        padding: 0 0.5rem;
    }
    .cat-title {
        font-size: 1.5rem; 
        font-weight: 900; 
        color: var(--cat-navy); 
        line-height: 1.2; 
        letter-spacing: -0.02em;
    }
    .cat-subtitle {
        font-size: 0.8rem; 
        color: var(--cat-accent); 
        font-weight: 600; 
        margin-top: 2px;
    }
    
    .btn-add-cat {
        background-color: var(--cat-indigo); 
        color: white;
        padding: 0.5rem 1.25rem; 
        border-radius: var(--cat-radius-xl); 
        font-size: 0.875rem; 
        font-weight: 700; 
        display: flex; 
        align-items: center; 
        gap: 6px;
        box-shadow: 0 4px 6px -1px #04437733;
        transition: all 0.2s ease; 
        border: none;
    }
    .btn-add-cat:hover {
        transform: translateY(-2px); 
        box-shadow: 0 6px 12px -2px #0443774d;
        background-color: #033055; 
        color: white;
    }

    /* Smart Toolbar Search */
    .cat-toolbar {
        background: var(--cat-white);
        border-radius: 2rem; 
        padding: 0.5rem 1rem; 
        display: flex; 
        align-items: center;
        box-shadow: 0 2px 4px -1px #0000000d;
        margin-bottom: 1rem; 
        width: 100%; 
        max-width: 1200px;
    }
    .search-box {
        flex-grow: 1; 
        position: relative;
    }
    .search-input {
        width: 100%; 
        background: #F8FAFC; 
        border: 1px solid transparent;
        border-radius: 1.5rem; 
        padding: 0.5rem 1rem 0.5rem 2.5rem; 
        font-size: 0.875rem; 
        font-weight: 600; 
        color: var(--cat-navy); 
        transition: 0.2s;
    }
    .search-input:focus { 
        background: white; 
        border-color: var(--cat-indigo); 
        outline: none; }
    .search-icon {
        position: absolute; 
        left: 1rem; 
        top: 50%; 
        transform: translateY(-50%);
        color: var(--cat-accent); 
        font-size: 0.875rem;
    }

    /* Categories Table Container */
    .cat-container {
        background: var(--cat-white);
        border-radius: var(--cat-radius-3xl); 
        padding: 0; 
        overflow: hidden;
        box-shadow: var(--cat-shadow);
        min-height: 400px;
    }

    .cat-table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0; 
    }
    
    .cat-table th {
        background: rgba(240, 248, 255, 0.3);
        padding: 0.85rem 1.5rem; 
        font-size: 0.7rem; 
        font-weight: 900;
        text-transform: uppercase; 
        letter-spacing: 0.1em;
        color: #64748b; 
        text-align: left;
        border-bottom: 1px solid #eff6ff;
    }
    
    .cat-table td {
        padding: 0.75rem 1.5rem; 
        border-bottom: 1px solid #f8fafc;
        vertical-align: middle; 
        transition: background 0.2s;
    }
    
    .cat-table tr:hover td { 
        background-color: #F0F9FF; 
    }

    /* Column Styles */
    .cat-name-box { 
        display: flex; 
        align-items: center; 
        gap: 0.75rem; 
    }
    .icon-square {
        width: 32px; height: 32px; 
        border-radius: 10px; 
        background: #e0e7ff; 
        color: var(--cat-indigo);
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 0.9rem;
    }
    .cat-name-text { 
        font-weight: 800; 
        color: var(--cat-navy); 
        font-size: 0.9rem; 
    }
    
    .cat-desc { 
        color: #64748b; 
        font-size: 0.85rem; 
        font-weight: 500; 
        max-width: 250px; 
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
    }
    
    .meta-info { 
        display: flex; 
        align-items: center; 
        gap: 6px; font-size: 0.8rem; 
        color: #94a3b8; 
        font-weight: 600; }
    .meta-icon { 
        color: #cbd5e1; 
    }
    /* Actions */
    .row-actions { 
        opacity: 0; 
        transition: opacity 0.2s; 
        display: flex; 
        gap: 6px; 
        justify-content: flex-end; }
    .cat-table tr:hover .row-actions { 
        opacity: 1; 
    }
    
    .btn-action {
        width: 30px; 
        height: 30px; 
        border-radius: 10px; 
        border: none;
        display: flex; 
        align-items: center; 
        justify-content: center;
        transition: 0.2s; 
    }
    .btn-action i { 
        font-size: 0.8rem; 
    }
    .btn-edit { 
        background: #e0f2fe; 
        color: var(--cat-indigo); 
    }
    .btn-edit:hover { 
        background: var(--cat-indigo); 
        color: white; 
    }
    .btn-delete { 
        background: #ffe4e6; 
        color: #e11d48; 
    }
    .btn-delete:hover { 
        background: #e11d48; 
        color: white; 
    }

    .modal-soft .modal-content {
        border-radius: var(--cat-radius-3xl); 
        border: none;
        box-shadow: 0 20px 25px -5px #0116281a;
        padding: 0.5rem; 
    }
    .modal-backdrop.show { 
        backdrop-filter: blur(2px); 
        opacity: 0.5; 
        background-color: #011628; 
    }
    
    .modal-header { 
        border-bottom: none; 
        padding: 1rem 1.5rem; 
    } 
    .modal-body { 
        padding: 0.5rem 1.5rem 1.5rem; 
    } 
    .modal-title-custom { 
        font-weight: 900; 
        color: var(--cat-navy); 
        font-size: 1.25rem; 
    }
    .form-label-soft {
        font-size: 0.7rem; 
        font-weight: 800; 
        text-transform: uppercase;
        letter-spacing: 0.05em; 
        color: var(--cat-accent); 
        margin-bottom: 0.25rem; 
        display: block;
    }
    .form-input-soft {
        width: 100%; padding: 0.6rem 1rem; 
        border-radius: var(--cat-radius-lg); 
        background: #F8FAFC; 
        border: 1px solid #e2e8f0;
        font-weight: 600; 
        color: var(--cat-navy); 
        font-size: 0.9rem;
        transition: 0.2s;
    }
    .form-input-soft:focus { 
        outline: none; 
        border-color: var(--cat-indigo); 
        background: white; 
        box-shadow: 0 0 0 4px #0443771a; }
    textarea.form-input-soft { 
        min-height: 100px; 
        resize: none; 
    }
    /* Animation */
    .zoom-in { 
        animation: zoomIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
    }
    @keyframes zoomIn { from { 
        opacity: 0; 
        transform: scale(0.95); 
        } to { 
            opacity: 1; 
            transform: scale(1); 
            } 
        }
</style>
<div class="cat-wrapper zoom-in">
    <div class="cat-header">
        <div>
            <div class="cat-title">Quản lý danh mục</div>
            <div class="cat-subtitle">Phân loại sản phẩm cho cửa hàng</div>
        </div>
        <button type="button" class="btn-add-cat" onclick="openAddModal()">
            <i class="fas fa-plus" style="font-size: 0.8rem"></i> Thêm danh mục
        </button>
    </div>

    <div class="d-flex justify-content-center">
        <div class="cat-toolbar">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm tên danh mục...">
            </div>
        </div>
    </div>

    <div class="cat-container">
        <div class="table-responsive">
            <table class="cat-table">
                <thead>
                    <tr>
                        <th width="35%">Tên danh mục</th>
                        <th width="30%">Mô tả</th>
                        <th>Người tạo</th>
                        <th>Ngày tạo</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody id="categoryTableBody">
                    <?php foreach ($categories as $cat): ?>
                    <tr class="cat-row" data-name="<?= strtolower($cat->name) ?>">
                        <td>
                            <div class="cat-name-box">
                                <div class="icon-square"><i class="fas fa-tag"></i></div>
                                <span class="cat-name-text"><?= htmlspecialchars($cat->name) ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="cat-desc"><?= htmlspecialchars($cat->description) ?></div>
                        </td>
                        <td>
                            <div class="meta-info">
                                <i class="fas fa-user-circle meta-icon"></i>
                                <?= htmlspecialchars($cat->creator_name ?? 'Hệ thống') ?>
                            </div>
                        </td>
                        <td>
                            <div class="meta-info">
                                <i class="fas fa-calendar-alt meta-icon"></i>
                                <?= date('d/m/Y', strtotime($cat->created_at)) ?>
                            </div>
                        </td>
                        <td>
                            <div class="row-actions">
                                <button class="btn-action btn-edit" onclick='openEditModal(<?= json_encode($cat) ?>)'>
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn-action btn-delete" onclick="deleteCategory(<?= $cat->id ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if(empty($categories)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted fw-bold">
                            Chưa có danh mục nào. Hãy thêm mới!
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade modal-soft" id="categoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-custom" id="modalTitle">Thêm danh mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    <input type="hidden" name="id" id="cat_id">
                    
                    <div class="mb-3"> <label class="form-label-soft">Tên danh mục</label>
                        <input type="text" class="form-input-soft" name="name" id="cat_name" required placeholder="Ví dụ: Điện thoại, Phụ kiện...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label-soft">Mô tả chi tiết</label>
                        <textarea class="form-input-soft" name="description" id="cat_desc" placeholder="Nhập mô tả cho danh mục này..."></textarea>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="button" class="btn btn-light btn-sm flex-grow-1 rounded-pill fw-bold py-2" data-bs-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary btn-sm flex-grow-1 rounded-pill fw-bold py-2" style="background: var(--cat-indigo); border:none">
                            Hoàn tất
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Search
    $('#searchInput').on('keyup', function() {
        const term = $(this).val().toLowerCase();
        $('.cat-row').each(function() {
            const name = $(this).data('name').toString();
            if (name.includes(term)) $(this).show();
            else $(this).hide();
        });
    });

    //Modal Logic 
    let isEdit = false;
    const modal = new bootstrap.Modal(document.getElementById('categoryModal'));

    function openAddModal() {
        isEdit = false;
        $('#modalTitle').text('Thêm danh mục mới');
        $('#categoryForm')[0].reset();
        $('#cat_id').val('');
        modal.show();
    }

    function openEditModal(cat) {
        isEdit = true;
        $('#modalTitle').text('Cập nhật danh mục');
        $('#cat_id').val(cat.id);
        $('#cat_name').val(cat.name);
        $('#cat_desc').val(cat.description);
        modal.show();
    }

    // AJAX Actions 
    $('#categoryForm').submit(function(e) {
        e.preventDefault();
        const data = $(this).serialize();
        const url = isEdit ? '/categories/update' : '/categories/store';

        $.post(url, data, function(res) {
            if(res.success) {
                location.reload();
            } else {
                alert(res.message);
            }
        }, 'json');
    });

    function deleteCategory(id) {
        if(confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
            $.post('/categories/delete', {id: id}, function(res) {
                if(res.success) location.reload();
                else alert(res.message);
            }, 'json');
        }
    }
</script>