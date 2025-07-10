<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="dashboard-container">
  <div class="dashboard-all-bookings">
    <div class="dashboard-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
      <div class="dashboard-title">All Rooms</div>
      <div class="dashboard-actions" style="display: flex; gap: 8px; align-items: center;">
        <!-- search bar chỉ search theo name_type_room -->
        <form class="search-bar" method="get" style="display: flex; align-items: center;">
          <input type="text" class="search-bar" name="name_type_room" placeholder="Search by room type name..." value="<?= htmlspecialchars($_GET['name_type_room'] ?? '') ?>">
          <button type="submit" style="background: none; border: none; cursor: pointer; margin-left: 4px;"><i class="fa fa-search"></i></button>
        </form>
        <button class="add-room-btn" style="background: none; border: none; cursor: pointer; font-size: 22px; color: #007bff; margin-left: 4px;" title="Thêm loại phòng mới" onclick="openAddTypeRoomModal()">
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="dashboard-table-wrapper">
      <table class="dashboard-table">
        <thead>
          <tr>
            <th>Room ID</th>
            <th>Room Type</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $type): ?>
                    <tr>
                        <td style="width: 100px;"><?= htmlspecialchars($type['id_type_room'] ?? '') ?></td>
                        <td><?= htmlspecialchars($type['name_type_room'] ?? '') ?></td>
                        <td style="width: 700px;"><?= htmlspecialchars($type['description'] ?? '') ?></td>
                        <td>
                            <!-- Edit/Delete buttons, can be implemented with modals or links -->
                            <button title="Edit" style="background: none; border: none; color: #007bff; cursor: pointer;" onclick='openEditTypeRoomModal(<?= json_encode($type) ?>)'><i class="fa fa-edit"></i></button>
                            <button title="Delete" style="background: none; border: none; color: #dc3545; cursor: pointer;" onclick="deleteTypeRoom('<?= htmlspecialchars($type['id_type_room']) ?>', this)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">No room types found.</td></tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- Modal Thêm Loại Phòng -->
<div id="addTypeRoomModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeAddTypeRoomModal()">&times;</span>
        <h3 class="add-room-title">Add new room type</h3>
        <form class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/roomtypes/add" >
            <label class="add-room-label">Room type:</label>
            <input type="text" name="name_type_room" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Description:</label>
            <textarea name="description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <button type="submit" name="submit" class="btn-add-room">Add</button>
        </form>
    </div>
</div>

<!-- Modal Edit Loại Phòng -->
<div id="editTypeRoomModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditTypeRoomModal()">&times;</span>
        <h3 class="add-room-title">Edit room type</h3>
        <form id="editTypeRoomForm" class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/roomtypes/edit">
            <input type="hidden" name="id_type_room" id="edit_id_type_room">
            <label class="add-room-label">Room type:</label>
            <input type="text" name="name_type_room" id="edit_name_type_room" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Description:</label>
            <textarea name="description" id="edit_description_type_room" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <button type="submit" name="submit" class="btn-add-room">Save</button>
        </form>
    </div>
</div>

<script>
    function openAddTypeRoomModal() {
        document.getElementById('addTypeRoomModal').style.display = 'flex';
    }
    function closeAddTypeRoomModal() {
        document.getElementById('addTypeRoomModal').style.display = 'none';
    }
    function openEditTypeRoomModal(type) {
        document.getElementById('edit_id_type_room').value = type.id_type_room;
        document.getElementById('edit_name_type_room').value = type.name_type_room || '';
        document.getElementById('edit_description_type_room').value = type.description || '';
        document.getElementById('editTypeRoomModal').style.display = 'flex';
    }
    function closeEditTypeRoomModal() {
        document.getElementById('editTypeRoomModal').style.display = 'none';
    }
    function deleteTypeRoom(id_type_room, btn) {
        if (!confirm('Bạn có chắc chắn muốn xóa loại phòng này?')) return;
        fetch('<?= $this->configs->config['basePath'] ?>/admin/roomtypes/delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id_type_room=' + encodeURIComponent(id_type_room)
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

    // --- BẮT ĐẦU: Logic disable/enable nút submit khi không thay đổi nội dung (edit type room) ---
    const editTypeRoomForm = document.getElementById('editTypeRoomForm');
    const editTypeRoomSubmitBtn = editTypeRoomForm.querySelector('button[type="submit"]');
    let originalTypeRoomData = {};

    function getEditTypeRoomFormData() {
        return {
            id_type_room: document.getElementById('edit_id_type_room').value,
            name_type_room: document.getElementById('edit_name_type_room').value,
            description: document.getElementById('edit_description_type_room').value,
        };
    }
    function isEditTypeRoomChanged() {
        const current = getEditTypeRoomFormData();
        for (let key in originalTypeRoomData) {
            if ((originalTypeRoomData[key] || '') !== (current[key] || '')) return true;
        }
        return false;
    }
    function updateEditTypeRoomBtnState() {
        if (isEditTypeRoomChanged()) {
            editTypeRoomSubmitBtn.disabled = false;
            editTypeRoomSubmitBtn.style.background = '#007bff';
            editTypeRoomSubmitBtn.style.cursor = 'pointer';
            editTypeRoomSubmitBtn.style.opacity = '1';
        } else {
            editTypeRoomSubmitBtn.disabled = true;
            editTypeRoomSubmitBtn.style.background = '#ccc';
            editTypeRoomSubmitBtn.style.cursor = 'not-allowed';
            editTypeRoomSubmitBtn.style.opacity = '0.7';
        }
    }
    function attachEditTypeRoomEvents() {
        editTypeRoomForm.querySelectorAll('input, textarea').forEach(el => {
            el.addEventListener('input', updateEditTypeRoomBtnState);
            el.addEventListener('change', updateEditTypeRoomBtnState);
        });
    }
    const oldOpenEditTypeRoomModal = openEditTypeRoomModal;
    openEditTypeRoomModal = function(type) {
        oldOpenEditTypeRoomModal(type);
        originalTypeRoomData = {
            id_type_room: document.getElementById('edit_id_type_room').value,
            name_type_room: document.getElementById('edit_name_type_room').value,
            description: document.getElementById('edit_description_type_room').value,
        };
        updateEditTypeRoomBtnState();
        attachEditTypeRoomEvents();
    }
    if (editTypeRoomSubmitBtn) {
        editTypeRoomSubmitBtn.disabled = true;
        editTypeRoomSubmitBtn.style.background = '#ccc';
        editTypeRoomSubmitBtn.style.cursor = 'not-allowed';
        editTypeRoomSubmitBtn.style.opacity = '0.7';
    }
    // --- KẾT THÚC: Logic disable/enable nút submit khi không thay đổi nội dung (edit type room) ---
</script>