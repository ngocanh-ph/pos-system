<style>
    /* --- DESIGN SYSTEM: CATEGORY MANAGER --- */
    :root {
        --pm-bg: #F0F8FF;         
        --pm-navy: #011628;       
        --pm-blue: #044377;       
        --pm-white: #FFFFFF;      
        --pm-radius-3xl: 3rem;    
        --pm-radius-xl: 1.5rem;   
        --pm-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05); 
    }

    .category-wrapper {
        background-color: var(--pm-bg);
        font-family: 'Inter', sans-serif;
        color: var(--pm-navy);
        padding: 0.5rem;
    }

    /* Header & Title */
    .pm-header {
        display: flex; 
        justify-content: space-between; 
        align-items: flex-end;
        margin-bottom: 1.5rem; 
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
        font-size: 0.85rem; 
        color: #64748b; 
        font-weight: 500; 
        margin-top: 0.2rem;
    }
    
    .btn-add-new {
        background-color: var(--pm-blue); 
        color: white;
        padding: 0.6rem 1.25rem; 
        border-radius: var(--pm-radius-xl);
        font-size: 0.875rem; 
        font-weight: 600; 
        display: flex; 
        align-items: center; 
        gap: 6px;
        box-shadow: 0 4px 10px -2px #04437740;
        transition: all 0.2s ease; 
        text-decoration: none; 
        border: none; 
    }
    .btn-add-new:hover { 
        background-color: #033055; 
        transform: translateY(-2px); 
        box-shadow: 0 6px 15px -3px #0443774d;
        color: white;
    }

    /* Container Design */
    .pm-container {
        background: var(--pm-white);
        border-radius: var(--pm-radius-3xl);
        padding: 0; 
        overflow: hidden; 
        box-shadow: var(--pm-shadow);
        min-height: 60vh;
        display: flex;
        flex-direction: column;
    }

    /* Table Design */
    .table-responsive { 
        width: 100%; 
        height: 100%; 
        display: flex; 
        flex-direction: column; 
    }
    .pm-table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0; 
        flex-grow: 1;
    }
    
    .pm-table th {
        background: #F8FAFC; 
        padding: 1rem 1.5rem; 
        font-size: 0.75rem; 
        font-weight: 800; 
        text-transform: uppercase;
        letter-spacing: 0.05em; 
        color: #64748b; 
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    .pm-table td {
        padding: 1.25rem 1.5rem; 
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .pm-table th:first-child, .pm-table td:first-child { padding-left: 2rem; }
    .pm-table th:last-child, .pm-table td:last-child { padding-right: 2rem; }

    .pm-table tr:hover td { 
        background-color: #F8FAFC; 
    }
    
    .cat-name { 
        font-weight: 700; 
        color: var(--pm-navy); 
        font-size: 1rem; 
    }
    .cat-desc { 
        font-size: 0.9rem; 
        color: #475569; 
        line-height: 1.4;
    }
    .cat-meta { 
        font-size: 0.8rem; 
        color: #64748b; 
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 0.2rem;
    }

    /* Empty State */
    .empty-row td {
        text-align: center;
        vertical-align: middle;
        height: 400px; 
    }
    .empty-state-content {
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center;
        color: #94a3b8;
    }

    /* Actions Buttons */
    .row-actions { 
        display: flex; 
        gap: 8px; 
        justify-content: center; 
        opacity: 1; 
    }
    
    .btn-icon {
        width: 32px; 
        height: 32px; 
        border-radius: 50%; 
        border: none;
        display: flex; 
        align-items: center; 
        justify-content: center;
        transition: all 0.2s ease; 
        cursor: pointer;
    }
    .btn-edit { 
        background: #e0f2fe; 
        color: #0284c7; 
    }
    .btn-edit:hover { 
        background: #0284c7; 
        color: white; 
        transform: scale(1.05); 
    }
    .btn-delete {
        background: #fee2e2; 
        color: #dc2626; 
    }
    .btn-delete:hover { 
        background: #dc2626; 
        color: white; 
        transform: scale(1.05); 
    }

    /* Modal Styling */
    .form-label-caps {
        font-size: 0.75rem; 
        font-weight: 700; 
        text-transform: uppercase;
        letter-spacing: 0.05em; 
        color: #64748b; 
        margin-bottom: 0.3rem; 
        display: block;
    }
    .form-input-lg {
        width: 100%; 
        padding: 0.75rem 1rem;
        border-radius: var(--pm-radius-xl);
        background: #F8FAFC; 
        border: 1px solid #e2e8f0;
        font-weight: 500; 
        font-size: 0.95rem; 
        color: var(--pm-navy);
        transition: all 0.2s;
    }
    .form-input-lg:focus { 
        outline: none; 
        border-color: var(--pm-blue); 
        background: white; 
        box-shadow: 0 0 0 3px #0443771a;
    }
    
    .fade-in { 
        animation: fadeIn 0.4s ease-out; 
    }
    @keyframes fadeIn { from { 
        opacity: 0; 
        transform: translateY(10px); 
        } to { 
            opacity: 1; 
            transform: translateY(0); 
            } 
        }
</style>

<div class="category-wrapper fade-in">
    <div class="pm-header">
        <div>
            <div class="pm-title">Quản lý danh mục</div>
            <div class="pm-subtitle">Phân loại sản phẩm hệ thống</div>
        </div>
        
        <?php if(isset($_SESSION['user']) && $_SESSION['user']->role === 'admin'): ?>
        <button type="button" class="btn-add-new" onclick="openAddModal()">
            <i class="fas fa-plus"></i> Thêm danh mục
        </button>
        <?php endif; ?>
    </div>

    <div class="pm-container">
        <div class="table-responsive">
            <table class="pm-table">
                <thead>
                    <tr>
                        <th width="25%">Tên danh mục</th>  
                        <th width="40%">Mô tả</th>        
                        <th width="20%">Người tạo</th>    
                        <?php if($_SESSION['user']->role === 'admin'): ?>
                            <th width="15%" style="text-align: center;">Thao tác</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($categories)): ?>
                        <?php foreach ($categories as $c): ?>
                        <tr class="category-row">
                            <td>
                                <div class="cat-name"><?= htmlspecialchars($c->name) ?></div>
                            </td>
                            <td>
                                <div class="cat-desc"><?= htmlspecialchars($c->description) ?></div>
                            </td>
                            <td>
                                <div class="cat-meta">
                                    <i class="fas fa-user-edit" style="color: #cbd5e1;"></i> 
                                    <span><?= htmlspecialchars($c->creator_name ?? 'N/A') ?></span>
                                </div>
                                <div class="cat-meta" style="color: #94a3b8; font-size: 0.75rem;">
                                    <i class="far fa-calendar-alt" style="color: #cbd5e1;"></i>
                                    <span><?= date('d/m/Y', strtotime($c->created_at)) ?></span>
                                </div>
                            </td>
                            <?php if($_SESSION['user']->role === 'admin'): ?>
                            <td>
                                <div class="row-actions">
                                    <button class="btn-icon btn-edit" title="Chỉnh sửa" onclick='openEditModal(<?= json_encode($c) ?>)'>
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn-icon btn-delete" title="Xóa" onclick="deleteCategory(<?= $c->id ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="empty-row">
                            <td colspan="4">
                                <div class="empty-state-content">
                                    <i class="fas fa-folder-open" style="font-size: 3.5rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                                    <div style="font-weight: 600; font-size: 1.1rem; color: var(--pm-navy);">Chưa có danh mục nào.</div>
                                    <div style="font-size: 0.9rem; margin-top: 0.5rem;">Hãy thêm danh mục mới để bắt đầu phân loại sản phẩm.</div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 2rem; border:none; padding: 0.5rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
            <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem;">
                <h5 class="modal-title fw-bold" id="modalTitle" style="color: var(--pm-navy); font-size: 1.25rem;">Thêm danh mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="categoryForm">
                    <input type="hidden" name="id" id="c_id">
                    
                    <div class="mb-4">
                        <label class="form-label-caps">Tên danh mục</label>
                        <input type="text" class="form-input-lg" name="name" id="c_name" required placeholder="Ví dụ: Điện thoại, Phụ kiện...">
                    </div>

                    <div class="mb-4">
                        <label class="form-label-caps">Mô tả</label>
                        <textarea class="form-input-lg" name="description" id="c_desc" rows="3" placeholder="Mô tả ngắn gọn..."></textarea>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="button" class="btn btn-light py-2 px-4 rounded-pill fw-bold" data-bs-dismiss="modal" style="color: #64748b; background: #f1f5f9; border: none;">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary py-2 px-4 flex-grow-1 rounded-pill fw-bold" style="background: var(--pm-navy); border:none; box-shadow: 0 4px 10px rgba(1, 22, 40, 0.2);">
                            Lưu dữ liệu
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
    let catModal;
    let isEdit = false;

    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('categoryModal');
        if (modalEl) {
            catModal = new bootstrap.Modal(modalEl);
        }

        $('#categoryForm').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const endpoint = isEdit ? '/categories/update' : '/categories/store';
            
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
                        $('#toastMessage').text(isEdit ? 'Cập nhật danh mục thành công!' : 'Thêm mới danh mục thành công!');
                        catModal.hide();
                        toast.show();
                        
                        // Cập nhật lại HTML ngầm (ko chớp trang)
                        $.get(location.href, function(newData) {
                            let parsedDOM = $('<div/>').append(newData);
                            let newTableContent = parsedDOM.find('.pm-container .table-responsive');
                            $('.pm-container').html(newTableContent);
                        });
                    } else {
                        $('#actionToast').removeClass('bg-success').addClass('bg-danger');
                        
                        // Dịch lỗi nếu trùng danh mục
                        let errorMsg = res.message || 'Có lỗi xảy ra!';
                        if (errorMsg.includes('1062 Duplicate entry') && errorMsg.includes('name')) {
                            errorMsg = 'Tên danh mục này đã tồn tại. Vui lòng nhập tên khác!';
                        } 
                        
                        $('#toastMessage').text('Lỗi: ' + errorMsg);
                        toast.show();
                    }
                },
                error: function(xhr) {
                    const toastEl = document.getElementById('actionToast');
                    $('#actionToast').removeClass('bg-success').addClass('bg-danger');
                    $('#toastMessage').text('Lỗi kết nối server: ' + xhr.statusText);
                    new bootstrap.Toast(toastEl).show();
                }
            });
        });
    });

    window.openAddModal = function() {
        isEdit = false;
        $('#modalTitle').text('Thêm danh mục mới');
        $('#categoryForm')[0].reset();
        $('#c_id').val('');
        if(catModal) catModal.show();
        else alert("Đang tải thư viện, vui lòng thử lại sau giây lát...");
    }

    window.openEditModal = function(cat) {
        isEdit = true;
        $('#modalTitle').text('Cập nhật danh mục');
        $('#c_id').val(cat.id);
        $('#c_name').val(cat.name);
        $('#c_desc').val(cat.description);
        if(catModal) catModal.show();
    }

    window.deleteCategory = function(id) {
        // Xóa trực tiếp không hỏi confirm
        $.post(BASE_URL + '/categories/delete', {id: id}, function(res) {
            const toastEl = document.getElementById('actionToast');
            const toast = new bootstrap.Toast(toastEl, { delay: 2500 }); 

            if(res.success) {
                $('#actionToast').removeClass('bg-danger').addClass('bg-success');
                $('#toastMessage').text('Xóa danh mục thành công!');
                toast.show();
                
                // Mờ dần dòng vừa bị xóa
                $('tr.category-row button[onclick="deleteCategory(' + id + ')"]').closest('tr').fadeOut(300, function() {
                    $(this).remove(); 
                });
            } else {
                $('#actionToast').removeClass('bg-success').addClass('bg-danger');
                $('#toastMessage').text('Lỗi: ' + (res.message || 'Không thể xóa danh mục này!'));
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