<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css?v=<?= time() ?>">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="dashboard-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
        <div class="dashboard-title">Guest Management</div>
        <div class="dashboard-search-container" style="margin-bottom:0;">
            <form method="GET" action="<?= $this->configs->config['basePath'] ?? '' ?>/admin/customers/guests"
                class="dashboard-search-form">
                <div class="search-bar-wrapper">
                    <span class="search-icon"><i class="fa fa-search"></i></span>
                    <input type="text" name="search" placeholder="Search by guest name..."
                        value="<?= htmlspecialchars($search ?? '') ?>" class="dashboard-search-input">
                </div>
            </form>
        </div>
    </div>
    <!-- Guests Table -->
    <div class="dashboard-table-wrapper">
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Guest ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Netizen ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($guests)): ?>
                    <?php foreach ($guests as $guest): ?>
                        <tr data-guest-id="<?= htmlspecialchars($guest['guest_id']) ?>">
                            <td><?= htmlspecialchars($guest['guest_id']) ?></td>
                            <td><?= htmlspecialchars($guest['full_name']) ?></td>
                            <td><?= htmlspecialchars($guest['email']) ?></td>
                            <td><?= htmlspecialchars($guest['sdt']) ?></td>
                            <td><?= htmlspecialchars($guest['cccd']) ?></td>
                            <td>
                                <span class="dashboard-action dashboard-action-delete"
                                    onclick="deleteGuest(<?= $guest['guest_id'] ?>)">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            <?= !empty($search) ? 'Không tìm thấy khách nào phù hợp.' : 'Không có khách nào.' ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    window.BASE_PATH = '<?= $this->configs->config["basePath"] ?? "" ?>';

    function deleteGuest(guestId) {
        if (confirm('Are you sure to delete this guest?')) {
            fetch(`${window.BASE_PATH}/admin/customers/guests/delete/${guestId}`, {
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
                    alert('Error :< ');
                });
        }
    }
</script>