<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css?v=<?= time() ?>">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="dashboard-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
        <div class="dashboard-title">User Management</div>
        <div class="dashboard-search-container" style="margin-bottom:0;">
            <form method="GET" action="<?= $this->configs->config['basePath'] ?? '' ?>/admin/customers/users" class="dashboard-search-form">
                <div class="search-bar-wrapper">
                    <span class="search-icon"><i class="fa fa-search"></i></span>
                    <input type="text" name="search" placeholder="Search by user name..." value="<?= htmlspecialchars($search ?? '') ?>" class="dashboard-search-input">
                </div>
            </form>
        </div>
    </div>
    <!-- Users Table -->
    <div class="dashboard-table-wrapper">
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Netizen ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr data-user-id="<?= htmlspecialchars($user['user_id']) ?>">
                            <td><?= htmlspecialchars($user['user_id']) ?></td>
                            <td><?= htmlspecialchars($user['full_name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['sdt']) ?></td>
                            <td><?= htmlspecialchars($user['cccd']) ?></td>
                            <td>
                                <span class="dashboard-action dashboard-action-delete" onclick="deleteUser(<?= $user['user_id'] ?>)">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            <?= !empty($search) ? 'Không tìm thấy user nào phù hợp.' : 'Không có user nào.' ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
window.BASE_PATH = '<?= $this->configs->config["basePath"] ?? "" ?>';
function deleteUser(userId) {
    if (confirm('Are you sure to delete this user?')) {
        fetch(`${window.BASE_PATH}/admin/customers/users/delete/${userId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error :<');
        });
    }
}
</script>
