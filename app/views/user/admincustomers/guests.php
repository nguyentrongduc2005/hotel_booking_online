<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="dashboard-container">
  <div class="dashboard-all-bookings">
    <div class="dashboard-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
      <div class="dashboard-title">All Guests</div>
      <div class="dashboard-actions" style="display: flex; gap: 8px; align-items: center;">
        <!-- search bar chỉ search theo tên khách hàng -->
        <form class="search-bar" method="get" style="display: flex; align-items: center;">
          <input type="text" class="search-bar" name="name" placeholder="Search by guest name..." value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
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
            <th>Guest ID</th>
            <th>Full Name</th>
            <th>Netizen ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
            <?php if (!empty($guests)): ?>
                <?php foreach ($guests as $guest): ?>
                    <tr>
                        <td><?= htmlspecialchars($guest['guest_id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($guest['full_name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($guest['netizen_id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($guest['email'] ?? '') ?></td>
                        <td><?= htmlspecialchars($guest['phone'] ?? '') ?></td>
                        <td><?= htmlspecialchars($guest['created_at'] ?? '') ?></td>
                        <td>
                            <button title="Edit" style="background: none; border: none; color: #007bff; cursor: pointer;" onclick='openEditGuestModal(<?= json_encode($guest) ?>)'><i class="fa fa-edit"></i></button>
                            <button title="Delete" style="background: none; border: none; color: #dc3545; cursor: pointer;" onclick="deleteGuest('<?= htmlspecialchars($guest['guest_id']) ?>', this)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;">No guests found.</td></tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div id="addAmenityModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeAddAmenityModal()">&times;</span>
        <h3 class="add-room-title">Thêm tiện nghi mới</h3>
        <form class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/amenities/add" >
            <label class="add-room-label">Tên tiện nghi:</label>
            <input type="text" name="name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Mô tả:</label>
            <textarea name="description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <button type="submit" name="submit" class="btn-add-room">Thêm tiện nghi</button>
        </form>
    </div>
</div>

<!-- Modal Edit Tiện Nghi -->
<div id="editAmenityModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditAmenityModal()">&times;</span>
        <h3 class="add-room-title">Chỉnh sửa tiện nghi</h3>
        <form id="editAmenityForm" class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/amenities/edit">
            <input type="hidden" name="amenity_id" id="edit_amenity_id">
            <label class="add-room-label">Tên tiện nghi:</label>
            <input type="text" name="name" id="edit_amenity_name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Mô tả:</label>
            <textarea name="description" id="edit_amenity_description" rows="4" cols="50" style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

            <button type="submit" name="submit" class="btn-add-room">Lưu thay đổi</button>
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
</script>