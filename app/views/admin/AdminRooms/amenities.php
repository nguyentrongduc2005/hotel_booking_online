<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="dashboard-container">
  <div class="dashboard-all-bookings">
    <div class="dashboard-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
      <div class="dashboard-title">All Amenities</div>
      <div class="dashboard-actions" style="display: flex; gap: 8px; align-items: center;">
        <!-- search bar chỉ search theo tên tiện nghi -->
        <form class="search-bar" method="get" style="display: flex; align-items: center;">
          <input type="text" class="search-bar" name="name" placeholder="Search by amenity name..." value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
          <button type="submit" style="background: none; border: none; cursor: pointer; margin-left: 4px;"><i class="fa fa-search"></i></button>
        </form>
        <button class="add-room-btn" style="background: none; border: none; cursor: pointer; font-size: 22px; color: #007bff; margin-left: 4px;" title="Thêm tiện nghi mới" onclick="openAddAmenityModal()">
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="dashboard-table-wrapper">
      <table class="dashboard-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Amenity</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $amenity): ?>
                    <tr>
                        <td><?= htmlspecialchars($amenity['amenity_id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($amenity['amenity_name'] ?? $amenity['name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($amenity['description_amenity'] ?? $amenity['description'] ?? '') ?></td>
                        <td>
                            <button title="Edit" style="background: none; border: none; color: #007bff; cursor: pointer;" onclick='openEditAmenityModal(<?= json_encode($amenity) ?>)'><i class="fa fa-edit"></i></button>
                            <button title="Delete" style="background: none; border: none; color: #dc3545; cursor: pointer;" onclick="deleteAmenity('<?= htmlspecialchars($amenity['amenity_id']) ?>', this)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">No amenities found.</td></tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div id="addAmenityModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeAddAmenityModal()">&times;</span>
        <h3 class="add-room-title">Adding new amenity</h3>
        <form class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/amenities/add" >
            <label class="add-room-label">Amenity:</label>
            <input type="text" name="name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Description:</label>
            <textarea name="description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <button type="submit" name="submit" class="btn-add-room">Add</button>
        </form>
    </div>
</div>

<!-- Modal Edit Tiện Nghi -->
<div id="editAmenityModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditAmenityModal()">&times;</span>
        <h3 class="add-room-title">Edit amenity:</h3>
        <form id="editAmenityForm" class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/amenities/edit">
            <input type="hidden" name="amenity_id" id="edit_amenity_id">
            <label class="add-room-label">Amenity:</label>
            <input type="text" name="name" id="edit_amenity_name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Description:</label>
            <textarea name="description" id="edit_amenity_description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <button type="submit" name="submit" class="btn-add-room">Save</button>
        </form>
    </div>
</div>

<script>
    function openAddAmenityModal() {
        document.getElementById('addAmenityModal').style.display = 'flex';
    }
    function closeAddAmenityModal() {
        document.getElementById('addAmenityModal').style.display = 'none';
    }
    function openEditAmenityModal(amenity) {
        document.getElementById('edit_amenity_id').value = amenity.amenity_id;
        document.getElementById('edit_amenity_name').value = amenity.amenity_name || amenity.name || '';
        document.getElementById('edit_amenity_description').value = amenity.description_amenity || amenity.description || '';
        document.getElementById('editAmenityModal').style.display = 'flex';
    }
    function closeEditAmenityModal() {
        document.getElementById('editAmenityModal').style.display = 'none';
    }
    function deleteAmenity(id_amenity, btn) {
        if (!confirm('Bạn có chắc chắn muốn xóa tiện nghi này?')) return;
        fetch('<?= $this->configs->config['basePath'] ?>/admin/amenities/delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id_amenity=' + encodeURIComponent(id_amenity)
        })
        .then(res => res.text())
        .then(text => {
            if (text.includes('success')) {
                location.reload();
            } else {
                alert('Xóa thất bại!\n' + text);
            }
        });
    }
    window.BASE_PATH = '<?= $this->configs->config["basePath"] ?? "" ?>';

    // --- BẮT ĐẦU: Logic disable/enable nút submit khi không thay đổi nội dung (edit amenity) ---
    const editAmenityForm = document.getElementById('editAmenityForm');
    const editAmenitySubmitBtn = editAmenityForm.querySelector('button[type="submit"]');
    let originalAmenityData = {};

    function getEditAmenityFormData() {
        return {
            amenity_id: document.getElementById('edit_amenity_id').value,
            name: document.getElementById('edit_amenity_name').value,
            description: document.getElementById('edit_amenity_description').value,
        };
    }
    function isEditAmenityChanged() {
        const current = getEditAmenityFormData();
        for (let key in originalAmenityData) {
            if ((originalAmenityData[key] || '') !== (current[key] || '')) return true;
        }
        return false;
    }
    function updateEditAmenityBtnState() {
        if (isEditAmenityChanged()) {
            editAmenitySubmitBtn.disabled = false;
            editAmenitySubmitBtn.style.background = '#007bff';
            editAmenitySubmitBtn.style.cursor = 'pointer';
            editAmenitySubmitBtn.style.opacity = '1';
        } else {
            editAmenitySubmitBtn.disabled = true;
            editAmenitySubmitBtn.style.background = '#ccc';
            editAmenitySubmitBtn.style.cursor = 'not-allowed';
            editAmenitySubmitBtn.style.opacity = '0.7';
        }
    }
    function attachEditAmenityEvents() {
        editAmenityForm.querySelectorAll('input, textarea').forEach(el => {
            el.addEventListener('input', updateEditAmenityBtnState);
            el.addEventListener('change', updateEditAmenityBtnState);
        });
    }
    const oldOpenEditAmenityModal = openEditAmenityModal;
    openEditAmenityModal = function(amenity) {
        oldOpenEditAmenityModal(amenity);
        originalAmenityData = {
            amenity_id: document.getElementById('edit_amenity_id').value,
            name: document.getElementById('edit_amenity_name').value,
            description: document.getElementById('edit_amenity_description').value,
        };
        updateEditAmenityBtnState();
        attachEditAmenityEvents();
    }
    if (editAmenitySubmitBtn) {
        editAmenitySubmitBtn.disabled = true;
        editAmenitySubmitBtn.style.background = '#ccc';
        editAmenitySubmitBtn.style.cursor = 'not-allowed';
        editAmenitySubmitBtn.style.opacity = '0.7';
    }
    // --- KẾT THÚC: Logic disable/enable nút submit khi không thay đổi nội dung (edit amenity) ---
</script>