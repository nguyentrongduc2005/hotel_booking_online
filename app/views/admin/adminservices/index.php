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

