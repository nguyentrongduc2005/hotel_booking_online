<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="dashboard-container">
  <div class="dashboard-all-bookings">
    <div class="dashboard-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
      <div class="dashboard-title">All Users</div>
      <div class="dashboard-actions" style="display: flex; gap: 8px; align-items: center;">
        <!-- search bar chỉ search theo tên user -->
        <form class="search-bar" method="get" style="display: flex; align-items: center;">
          <input type="text" class="search-bar" name="name" placeholder="Search by user name..." value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
          <button type="submit" style="background: none; border: none; cursor: pointer; margin-left: 4px;"><i class="fa fa-search"></i></button>
        </form>
        <button class="add-room-btn" style="background: none; border: none; cursor: pointer; font-size: 22px; color: #007bff; margin-left: 4px;" title="Thêm user mới" onclick="openAddUserModal()">
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="dashboard-table-wrapper">
      <table class="dashboard-table">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['user_id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['username'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['full_name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['phone'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['role'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['created_at'] ?? '') ?></td>
                        <td>
                            <button title="Edit" style="background: none; border: none; color: #007bff; cursor: pointer;" onclick='openEditUserModal(<?= json_encode($user) ?>)'><i class="fa fa-edit"></i></button>
                            <button title="Delete" style="background: none; border: none; color: #dc3545; cursor: pointer;" onclick="deleteUser('<?= htmlspecialchars($user['user_id']) ?>', this)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" style="text-align:center;">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div id="addUserModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeAddUserModal()">&times;</span>
        <h3 class="add-room-title">Thêm user mới</h3>
        <form class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/users/add" >
            <label class="add-room-label">Username:</label>
            <input type="text" name="username" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Full Name:</label>
            <input type="text" name="full_name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Email:</label>
            <input type="email" name="email" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Phone:</label>
            <input type="text" name="phone" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Password:</label>
            <input type="password" name="password" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Role:</label>
            <select name="role" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" name="submit" class="btn-add-room">Thêm user</button>
        </form>
    </div>
</div>

<!-- Modal Edit User -->
<div id="editUserModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditUserModal()">&times;</span>
        <h3 class="add-room-title">Chỉnh sửa user</h3>
        <form id="editUserForm" class="add-room-form" method="post" action="<?= $this->configs->config['basePath'] ?>/admin/users/edit">
            <input type="hidden" name="user_id" id="edit_user_id">
            <label class="add-room-label">Username:</label>
            <input type="text" name="username" id="edit_username" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Full Name:</label>
            <input type="text" name="full_name" id="edit_full_name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Email:</label>
            <input type="email" name="email" id="edit_email" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Phone:</label>
            <input type="text" name="phone" id="edit_phone" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Role:</label>
            <select name="role" id="edit_role" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" name="submit" class="btn-add-room">Lưu thay đổi</button>
        </form>
    </div>
</div>

<script>
    function openAddUserModal() {
        document.getElementById('addUserModal').style.display = 'flex';
    }
    function closeAddUserModal() {
        document.getElementById('addUserModal').style.display = 'none';
    }
    function openEditUserModal(user) {
        document.getElementById('edit_user_id').value = user.user_id;
        document.getElementById('edit_username').value = user.username || '';
        document.getElementById('edit_full_name').value = user.full_name || '';
        document.getElementById('edit_email').value = user.email || '';
        document.getElementById('edit_phone').value = user.phone || '';
        document.getElementById('edit_role').value = user.role || 'user';
        document.getElementById('editUserModal').style.display = 'flex';
    }
    function closeEditUserModal() {
        document.getElementById('editUserModal').style.display = 'none';
    }
    function deleteUser(user_id, btn) {
        if (!confirm('Bạn có chắc chắn muốn xóa user này?')) return;
        fetch('<?= $this->configs->config['basePath'] ?>/admin/users/delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'user_id=' + encodeURIComponent(user_id)
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
