<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css?v=<?= time() ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="dashboard-container">
  <div class="dashboard-all-bookings">
    <div class="dashboard-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
      <div class="dashboard-title">All Services</div>
      <div class="dashboard-actions" style="display: flex; gap: 8px; align-items: center;">
        <form class="dashboard-search-form" method="get" action="<?= $this->configs->config['basePath'] ?? '' ?>/admin/services" style="display: flex; align-items: center;">
          <div class="search-bar-wrapper">
            <span class="search-icon"><i class="fa fa-search"></i></span>
            <input type="text" class="dashboard-search-input" name="search" placeholder="Tìm kiếm theo tên dịch vụ..." value="<?= htmlspecialchars($search ?? '') ?>">
          </div>
        </form>
        <button class="add-room-btn" style="background: none; border: none; cursor: pointer; font-size: 22px; color: #007bff; margin-left: 4px;" title="Thêm dịch vụ mới" onclick="openAddServiceModal()">
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="dashboard-table-wrapper">
      <table class="dashboard-table">
        <thead>
          <tr>
            <th>Service ID</th>
            <th>Service Name</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?= htmlspecialchars($service['id_service'] ?? '') ?></td>
                        <td><?= htmlspecialchars($service['name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($service['description'] ?? '') ?></td>
                        <td>
                            <button title="Edit" style="background: none; border: none; color: #007bff; cursor: pointer;" onclick='openEditServiceModal(<?= json_encode($service) ?>)'><i class="fa fa-edit"></i></button>
                            <button title="Delete" style="background: none; border: none; color: #dc3545; cursor: pointer;" onclick="deleteService(<?= $service['id_service'] ?>)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">Không có dịch vụ nào.</td></tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Popup Thêm dịch vụ -->
<div id="addServiceModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeAddServiceModal()">&times;</span>
        <h3 class="add-room-title">Add service</h3>
        <form id="addServiceForm" class="add-room-form" enctype="multipart/form-data">
            <label class="add-room-label">Service:</label>
            <input type="text" name="name" id="add_service_name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>
            <label class="add-room-label">Description:</label>
            <textarea name="description" id="add_service_description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>
            <label class="add-room-label">Select images:</label>
            <input type="file" name="image" id="add_service_image_input" accept="image/*" required>
            <div id="add-service-image-preview" style="display: flex; gap: 8px; margin-bottom: 12px; justify-content: center;"></div>
            <button type="submit" class="btn-add-room">Add</button>
        </form>
    </div>
</div>

<!-- Popup Sửa dịch vụ -->
<div id="editServiceModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditServiceModal()">&times;</span>
        <h3 class="add-room-title">Edit service</h3>
        <form id="editServiceForm" class="add-room-form" enctype="multipart/form-data">
            <input type="hidden" name="service_id" id="edit_service_id">
            <label class="add-room-label">Service:</label>
            <input type="text" name="name" id="edit_service_name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>
            <label class="add-room-label">Description:</label>
            <textarea name="description" id="edit_service_description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>
            <label class="add-room-label">Current images:</label>
            <div id="edit-service-image-box" style="display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 10px;"></div>
            <label class="add-room-label">New images:</label>
            <input type="file" name="image" id="edit_service_image_input" accept="image/*">
            <div id="edit-service-image-preview" style="display: flex; gap: 8px; margin-bottom: 12px; justify-content: center;"></div>
            <button type="submit" class="btn-add-room">Save</button>
        </form>
    </div>
</div>

<script>
// Mở popup thêm
function openAddServiceModal() {
    document.getElementById('addServiceModal').style.display = 'flex';
    document.getElementById('addServiceForm').reset();
    document.getElementById('add-service-image-preview').innerHTML = '';
}
function closeAddServiceModal() {
    document.getElementById('addServiceModal').style.display = 'none';
}
// Mở popup sửa
function openEditServiceModal(service) {
    document.getElementById('edit_service_id').value = service.id_service;
    document.getElementById('edit_service_name').value = service.name;
    document.getElementById('edit_service_description').value = service.description;
    // Hiện ảnh hiện tại
    const imageBox = document.getElementById('edit-service-image-box');
    imageBox.innerHTML = '';
    if (service.Path_img) {
        const imgBox = document.createElement('div');
        imgBox.style.position = 'relative';
        imgBox.style.display = 'inline-block';
        imgBox.style.width = '90px';
        imgBox.style.height = '70px';
        imgBox.style.border = '1px solid #ccc';
        imgBox.style.borderRadius = '6px';
        imgBox.style.overflow = 'hidden';
        imgBox.style.background = '#f8f8f8';
        imgBox.style.marginRight = '6px';
        imgBox.style.marginBottom = '6px';
        const image = document.createElement('img');
        image.src = '<?= $this->configs->config['pathAssets'] ?>' + service.Path_img;
        image.style.width = '100%';
        image.style.height = '100%';
        image.style.objectFit = 'cover';
        imgBox.appendChild(image);
        imageBox.appendChild(imgBox);
    }
    document.getElementById('edit-service-image-preview').innerHTML = '';
    document.getElementById('edit_service_image_input').value = '';
    document.getElementById('editServiceModal').style.display = 'flex';
}
function closeEditServiceModal() {
    document.getElementById('editServiceModal').style.display = 'none';
}
// Preview ảnh khi chọn ở thêm dịch vụ
    document.getElementById('add_service_image_input')?.addEventListener('change', function(e) {
        const preview = document.getElementById('add-service-image-preview');
        preview.innerHTML = '';
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.style.width = '90px';
                img.style.height = '70px';
                img.style.objectFit = 'cover';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '6px';
                img.style.marginRight = '6px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
// Preview ảnh khi chọn ở sửa dịch vụ
    document.getElementById('edit_service_image_input')?.addEventListener('change', function(e) {
        const preview = document.getElementById('edit-service-image-preview');
        preview.innerHTML = '';
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.style.width = '90px';
                img.style.height = '70px';
                img.style.objectFit = 'cover';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '6px';
                img.style.marginRight = '6px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
// Submit form thêm dịch vụ
    document.getElementById('addServiceForm').onsubmit = function(e) {
        e.preventDefault();
        const form = document.getElementById('addServiceForm');
        const formData = new FormData(form);
        fetch('<?= $this->configs->config["basePath"] ?? "" ?>/admin/services/create', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Adding new service successfully');
                closeAddServiceModal();
                window.location.reload();
            } else {
                alert('Thêm dịch vụ thất bại: ' + (data.error || 'Lỗi không xác định'));
            }
        })
        .catch(error => {
            alert('Lỗi hệ thống: ' + (error && error.message ? error.message : error));
        });
    };
// Submit form sửa dịch vụ
    document.getElementById('editServiceForm').onsubmit = function(e) {
        e.preventDefault();
        const form = document.getElementById('editServiceForm');
        const serviceId = document.getElementById('edit_service_id').value;
        const formData = new FormData(form);
        fetch('<?= $this->configs->config["basePath"] ?? "" ?>/admin/services/update/' + serviceId, {
            method: 'POST',
            body: formData
        })
        .then(async response => {
            let data;
            try {
                data = await response.json();
            } catch (err) {
                alert('Lỗi hệ thống: ' + (err && err.message ? err.message : err));
                return;
            }
            if (data.success) {
                alert('Update successfully');
                closeEditServiceModal();
                window.location.reload();
            } else {
                alert('Cập nhật dịch vụ thất bại: ' + (data.error || 'Lỗi không xác định'));
            }
        })
        .catch(error => {
            alert('Lỗi hệ thống: ' + (error && error.message ? error.message : error));
        });
    };
// Xóa dịch vụ
function deleteService(id) {
    if (!confirm('Are you sure to delete this service?')) return;
    fetch('<?= $this->configs->config["basePath"] ?? "" ?>/admin/services/delete/' + id, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Delete successfully');
            window.location.reload();
        } else {
            alert('Xóa dịch vụ thất bại: ' + (data.error || 'Lỗi không xác định'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Xóa dịch vụ thất bại! Vui lòng thử lại.');
    });
}
// --- BẮT ĐẦU: Logic disable/enable nút submit khi không thay đổi nội dung (edit service) ---
const editServiceForm = document.getElementById('editServiceForm');
const editServiceSubmitBtn = editServiceForm.querySelector('button[type="submit"]');
let originalServiceData = {};

function getEditServiceFormData() {
    return {
        service_id: document.getElementById('edit_service_id').value,
        name: document.getElementById('edit_service_name').value,
        description: document.getElementById('edit_service_description').value,
        // Chỉ kiểm tra file mới nếu có chọn
        image: document.getElementById('edit_service_image_input').value
    };
}
function isEditServiceChanged() {
    const current = getEditServiceFormData();
    for (let key in originalServiceData) {
        if ((originalServiceData[key] || '') !== (current[key] || '')) return true;
    }
    // Nếu chọn ảnh mới thì cũng cho phép submit
    if (current.image && current.image.length > 0) return true;
    return false;
}
function updateEditServiceBtnState() {
    if (isEditServiceChanged()) {
        editServiceSubmitBtn.disabled = false;
        editServiceSubmitBtn.style.background = '#007bff';
        editServiceSubmitBtn.style.cursor = 'pointer';
        editServiceSubmitBtn.style.opacity = '1';
    } else {
        editServiceSubmitBtn.disabled = true;
        editServiceSubmitBtn.style.background = '#ccc';
        editServiceSubmitBtn.style.cursor = 'not-allowed';
        editServiceSubmitBtn.style.opacity = '0.7';
    }
}
function attachEditServiceEvents() {
    editServiceForm.querySelectorAll('input, textarea').forEach(el => {
        el.addEventListener('input', updateEditServiceBtnState);
        el.addEventListener('change', updateEditServiceBtnState);
    });
}
const oldOpenEditServiceModal = openEditServiceModal;
openEditServiceModal = function(service) {
    oldOpenEditServiceModal(service);
    originalServiceData = {
        service_id: document.getElementById('edit_service_id').value,
        name: document.getElementById('edit_service_name').value,
        description: document.getElementById('edit_service_description').value,
        image: ''
    };
    updateEditServiceBtnState();
    attachEditServiceEvents();
}
if (editServiceSubmitBtn) {
    editServiceSubmitBtn.disabled = true;
    editServiceSubmitBtn.style.background = '#ccc';
    editServiceSubmitBtn.style.cursor = 'not-allowed';
    editServiceSubmitBtn.style.opacity = '0.7';
}
// --- KẾT THÚC: Logic disable/enable nút submit khi không thay đổi nội dung (edit service) ---
</script>

