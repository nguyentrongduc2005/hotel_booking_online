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


<div id="editServiceModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditServiceModal()">&times;</span>
        <h3 class="add-room-title">Chỉnh sửa dịch vụ</h3>
        <form id="editServiceForm" class="add-room-form" onsubmit="submitEditForm(event)">
            <input type="hidden" name="service_id" id="edit_service_id">
            <label class="add-room-label">Tên dịch vụ:</label>
            <input type="text" name="name" id="edit_service_name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>
            <label class="add-room-label">Mô tả:</label>
            <textarea name="description" id="edit_service_description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>
            <button type="submit" class="btn-add-room">Lưu thay đổi</button>
        </form>
    </div>
</div>

<div id="addServiceModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeAddServiceModal()">&times;</span>
        <h3 class="add-room-title">Thêm dịch vụ mới</h3>
        <form id="addServiceForm" class="add-room-form" onsubmit="submitAddForm(event)">
            <label class="add-room-label">Tên dịch vụ:</label>
            <input type="text" name="name" id="add_service_name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>
            <label class="add-room-label">Mô tả:</label>
            <textarea name="description" id="add_service_description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>
            <button type="submit" class="btn-add-room">Thêm dịch vụ</button>
        </form>
    </div>
</div>

<script>
    
function openEditServiceModal(service) {
    document.getElementById('edit_service_id').value = service.id_service;
    document.getElementById('edit_service_name').value = service.name;
    document.getElementById('edit_service_description').value = service.description;
    document.getElementById('editServiceModal').style.display = 'flex';
}
function closeEditServiceModal() {
    document.getElementById('editServiceModal').style.display = 'none';
}
function submitEditForm(event) {
    event.preventDefault();
    const serviceId = document.getElementById('edit_service_id').value;
    const name = document.getElementById('edit_service_name').value;
    const description = document.getElementById('edit_service_description').value;

    if (!name.trim()) {
        alert('Vui lòng nhập tên dịch vụ!');
        return;
    }

    const formData = new FormData();
    formData.append('name', name);
    formData.append('description', description);

    const url = '<?= $this->configs->config["basePath"] ?? "" ?>/admin/services/update/' + serviceId;

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Cập nhật dịch vụ thành công!');
            closeEditServiceModal();
            window.location.reload();
        } else {
            alert('Cập nhật dịch vụ thất bại: ' + (data.error || 'Lỗi không xác định'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Cập nhật dịch vụ thất bại! Vui lòng thử lại.');
    });
}
</script>