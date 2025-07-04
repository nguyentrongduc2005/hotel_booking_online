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


<div id="addRoomModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeAddRoomModal()">&times;</span>
        <h3 class="add-room-title">Thêm phòng mới</h3>
        <form class="add-room-form" method="post" enctype="multipart/form-data" action="<?= $this->configs->config['basePath'] ?>/admin/rooms/add" >
            <label class="add-room-label">Slug:</label>
            <input type="text" name="slug" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Name:</label>
            <input type="text" name="name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Description:</label>
            <textarea name="description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <label class="add-room-label">Number of beds:</label>
            <input type="number" name="amount_bed" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Price:</label>
            <input type="number" name="price" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Status:</label>
            <select name="status" required>
                <option value="available">Available</option>
                <option value="maintenance">Maintenance</option>
            </select>

            <label class="add-room-label">Area (m²):</label>
            <input type="number" name="area" style="width: 98%;" required>

            <label class="add-room-label">Capacity (người):</label>
            <input type="number" name="capacity" style="width: 98%;" required>

            <label class="add-room-label">Room type:</label>
            <select name="id_room_type" required>
                <option value="1">Standard Room</option>
                <option value="2">Superior Room</option>
                <option value="3">Deluxe Room</option>
                <option value="4">Suite Room</option>
                <option value="5">Family Room</option>
                <option value="6">Single Room</option>
            </select>

            <label class="add-room-label">Chọn tiện nghi (Amenity):</label>
            <div class="amenities-group">
                <label><input type="checkbox" name="amenities[]" value="1"> Wi-Fi</label>
                <label><input type="checkbox" name="amenities[]" value="2"> TV</label>
                <label><input type="checkbox" name="amenities[]" value="3"> Máy lạnh</label>
                <label><input type="checkbox" name="amenities[]" value="4"> Mini bar</label>
                <label><input type="checkbox" name="amenities[]" value="5"> Bồn tắm</label>
            </div>

            <label class="add-room-label">Upload nhiều ảnh:</label>
            <input type="file" name="images[]" multiple required>

            <button type="submit" name="submit" class="btn-add-room">Thêm phòng</button>
        </form>
    </div>
</div>

<div id="editRoomModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditRoomModal()">&times;</span>
        <h3 class="add-room-title">Chỉnh sửa phòng</h3>
        <form id="editRoomForm" class="add-room-form" method="post" enctype="multipart/form-data" action="<?= $this->configs->config['basePath'] ?>/admin/rooms/edit">
            <input type="hidden" name="id_room" id="edit_id_room">
            <label class="add-room-label">Slug:</label>
            <input type="text" name="slug" id="edit_slug" style="width: 98%; font-family: 'SVN-Gilroy';" required>

            <label class="add-room-label">Name:</label>
            <input type="text" name="name" id="edit_name" style="width: 98%; font-family: 'SVN-Gilroy';" required>

            <label class="add-room-label">Description:</label>
            <textarea name="description" id="edit_description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy';"></textarea>

            <label class="add-room-label">Number of beds:</label>
            <input type="number" name="amount_bed" id="edit_amount_bed" style="width: 98%; font-family: 'SVN-Gilroy';" required>

            <label class="add-room-label">Price:</label>
            <input type="number" name="price" id="edit_price" style="width: 98%; font-family: 'SVN-Gilroy';" required>

            <label class="add-room-label">Status:</label>
            <select name="status" id="edit_status" required>
                <option value="available">Available</option>
                <option value="maintenance">Maintenance</option>
            </select>

            <label class="add-room-label">Area (m²):</label>
            <input type="number" name="area" id="edit_area" style="width: 98%; font-family: 'SVN-Gilroy';" required>

            <label class="add-room-label">Capacity (người):</label>
            <input type="number" name="capacity" id="edit_capacity" style="width: 98%; font-family: 'SVN-Gilroy';" required>

            <label class="add-room-label">Room type:</label>
            <select name="id_room_type" id="edit_id_room_type" required>
                <option value="1">Standard Room</option>
                <option value="2">Superior Room</option>
                <option value="3">Deluxe Room</option>
                <option value="4">Suite Room</option>
                <option value="5">Family Room</option>
                <option value="6">Single Room</option>
            </select>

            <label class="add-room-label">Chọn tiện nghi (Amenity):</label>
            <div class="amenities-group">
                <label><input type="checkbox" name="amenities[]" value="1" class="edit-amenity"> Wi-Fi</label>
                <label><input type="checkbox" name="amenities[]" value="2" class="edit-amenity"> TV</label>
                <label><input type="checkbox" name="amenities[]" value="3" class="edit-amenity"> Máy lạnh</label>
                <label><input type="checkbox" name="amenities[]" value="4" class="edit-amenity"> Mini bar</label>
                <label><input type="checkbox" name="amenities[]" value="5" class="edit-amenity"> Bồn tắm</label>
            </div>

            <label class="add-room-label">Upload nhiều ảnh (nếu muốn thay):</label>
            <input type="file" name="new_images[]" multiple>

            <button type="submit" name="submit" class="btn-add-room">Lưu thay đổi</button>
        </form>
    </div>
</div>

<!-- Modal Thêm Loại Phòng -->
<div id="addTypeRoomModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeAddTypeRoomModal()">&times;</span>
        <h3 class="add-room-title">Thêm loại phòng mới</h3>
        <form class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/roomtypes/add" >
            <label class="add-room-label">Tên loại phòng:</label>
            <input type="text" name="name_type_room" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Mô tả:</label>
            <textarea name="description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <button type="submit" name="submit" class="btn-add-room">Thêm loại phòng</button>
        </form>
    </div>
</div>

<!-- Modal Edit Loại Phòng -->
<div id="editTypeRoomModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditTypeRoomModal()">&times;</span>
        <h3 class="add-room-title">Chỉnh sửa loại phòng</h3>
        <form id="editTypeRoomForm" class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/roomtypes/edit">
            <input type="hidden" name="id_type_room" id="edit_id_type_room">
            <label class="add-room-label">Tên loại phòng:</label>
            <input type="text" name="name_type_room" id="edit_name_type_room" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Mô tả:</label>
            <textarea name="description" id="edit_description_type_room" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <button type="submit" name="submit" class="btn-add-room">Lưu thay đổi</button>
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
</script>