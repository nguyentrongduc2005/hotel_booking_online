<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="dashboard-container">
    <div class="dashboard-all-bookings">
        <div class="dashboard-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <div class="dashboard-title">All Rooms</div>
            <div class="dashboard-actions" style="display: flex; gap: 8px; align-items: center;">
                <!-- search bar căn phải nhỏ nhỏ vì t chỉnh width cho dài ra giống trong figma nhưng mà css qua lại nó vẫn lệch nên để nhỏ nha-->
                <form class="search-bar" method="get" style="display: flex; align-items: center;">
                    <input type="text" class="search-bar" name="name" placeholder="Search by room name..."
                        value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                    <button type="submit" style="background: none; border: none; cursor: pointer; margin-left: 4px;"><i
                            class="fa fa-search"></i></button>
                </form>
                <button class="filter-btn" style="background: none; border: none; cursor: pointer; font-size: 18px;"
                    title="Filter" onclick="openFilterModal()">
                    <i class="fa fa-filter"></i>
                </button>
                <button class="add-room-btn"
                    style="background: none; border: none; cursor: pointer; font-size: 22px; color: #007bff; margin-left: 4px;"
                    title="Thêm phòng mới" onclick="openAddRoomModal()">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="dashboard-table-wrapper">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Room ID</th>
                        <th>Name</th>
                        <th>Room Type</th>
                        <th>Area</th>
                        <th>Capacity</th>
                        <th>Bed</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $key => $room): ?>
                            <?php if (!is_numeric($key)) continue; // chỉ lấy các phần tử phòng 
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($room['id_room'] ?? '') ?></td>
                                <td><?= htmlspecialchars($room['name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($room['name_type_room'] ?? '') ?></td>
                                <td><?= htmlspecialchars($room['area'] ?? '') ?> m²</td>
                                <td><?= htmlspecialchars($room['capacity'] ?? '') ?></td>
                                <td><?= htmlspecialchars($room['amount_bed'] ?? '') ?></td>
                                <td><?= htmlspecialchars($room['price'] ?? '') ?></td>
                                <td>
                                    <?php
                                    $status = $room['status'] ?? '';
                                    if ($status === 'available') {
                                        echo '<span style="color: green;">Available</span>';
                                    } elseif ($status === 'maintenance') {
                                        echo '<span style="color: orange;">Maintenance</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button title="Edit"
                                        style="background: none; border: none; color: #007bff; cursor: pointer;"
                                        onclick='openEditRoomModal(<?= json_encode($room) ?>)'><i
                                            class="fa fa-edit"></i></button>
                                    <button title="Delete"
                                        style="background: none; border: none; color: #dc3545; cursor: pointer;"
                                        onclick="deleteRoom('<?= htmlspecialchars($room['id_room']) ?>', this)"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">No rooms found.</td>
                        </tr>
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
        <form class="add-room-form" method="post" enctype="multipart/form-data"
            action="<?= $this->configs->config['basePath'] ?>/admin/rooms/add">
            <label class="add-room-label">Slug:</label>
            <input type="text" name="slug" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Name:</label>
            <input type="text" name="name" style="width: 98%; font-family: 'SVN-Gilroy' !important;" required>

            <label class="add-room-label">Description:</label>
            <textarea name="description" rows="4" cols="50"
                style="width: 98%; font-family: 'SVN-Gilroy' !important;"></textarea>

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
            <div class="amenities-group" style="width: 100%; margin-top: 8px;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                    <tbody>
                        <?php
                        $total = count($amenities);
                        $cols = 2;
                        $rows = ceil($total / $cols);
                        for ($r = 0; $r < $rows; $r++) {
                            echo '<tr>';
                            for ($c = 0; $c < $cols; $c++) {
                                $idx = $r * $cols + $c;
                                echo '<td style="width: 48%; min-width: 220px; height: 48px; padding-bottom: 0; text-align: left; vertical-align: middle;">';
                                if (isset($amenities[$idx])) {
                                    $amenity = $amenities[$idx];
                                    echo '<label style="display: flex; align-items: center; gap: 8px; width: 100%; height: 100%; cursor: pointer; font-size: 16px; line-height: 1.4; margin-bottom: 0; white-space: normal;">';
                                    echo '<input type="checkbox" name="amenities[]" value="' . htmlspecialchars($amenity['amenity_id']) . '" class="edit-amenity">';
                                    echo '<span style="text-align: left;">' . htmlspecialchars($amenity['amenity_name']) . '</span>';
                                    echo '</label>';
                                }
                                echo '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <label class="add-room-label">Upload nhiều ảnh:</label>
            <input type="file" name="images[]" id="add_images_input" multiple>
            <div id="add-images-preview"
                style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px; justify-content: center;"></div>

            <button type="submit" name="submit" class="btn-add-room">Thêm phòng</button>
        </form>
    </div>
</div>

<div id="editRoomModal" class="modal-add-room" style="display: none;">
    <div class="modal-add-room-content">
        <span class="close-add-room" onclick="closeEditRoomModal()">&times;</span>
        <h3 class="add-room-title">Chỉnh sửa phòng</h3>
        <form id="editRoomForm" class="add-room-form" method="post" enctype="multipart/form-data"
            action="<?= $this->configs->config['basePath'] ?>/admin/rooms/edit">
            <input type="hidden" name="id_room" id="edit_id_room">
            <label class="add-room-label">Slug:</label>
            <input type="text" name="slug" id="edit_slug" style="width: 98%; font-family: 'SVN-Gilroy';" required>

            <label class="add-room-label">Name:</label>
            <input type="text" name="name" id="edit_name" style="width: 98%; font-family: 'SVN-Gilroy';" required>

            <label class="add-room-label">Description:</label>
            <textarea name="description" id="edit_description" rows="4" cols="50"
                style="width: 98%; font-family: 'SVN-Gilroy';"></textarea>

            <label class="add-room-label">Number of beds:</label>
            <input type="number" name="amount_bed" id="edit_amount_bed" style="width: 98%; font-family: 'SVN-Gilroy';"
                required>

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
            <input type="number" name="capacity" id="edit_capacity" style="width: 98%; font-family: 'SVN-Gilroy';"
                required>

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
            <div class="amenities-group" style="width: 100%; margin-top: 8px;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                    <tbody>
                        <?php
                        $total = count($amenities);
                        $cols = 2;
                        $rows = ceil($total / $cols);
                        for ($r = 0; $r < $rows; $r++) {
                            echo '<tr>';
                            for ($c = 0; $c < $cols; $c++) {
                                $idx = $r * $cols + $c;
                                echo '<td style="width: 48%; min-width: 220px; height: 48px; padding-bottom: 0; text-align: left; vertical-align: middle;">';
                                if (isset($amenities[$idx])) {
                                    $amenity = $amenities[$idx];
                                    echo '<label style="display: flex; align-items: left; width: 100%; height: 100%; cursor: pointer; font-size: 16px; line-height: 1.4; margin-bottom: 0; white-space: normal;">';
                                    echo '<input type="checkbox" name="amenities[]" value="' . htmlspecialchars($amenity['amenity_id']) . '" class="edit-amenity">';
                                    echo '<span style="text-align: left;">' . htmlspecialchars($amenity['amenity_name']) . '</span>';
                                    echo '</label>';
                                }
                                echo '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <label class="add-room-label">Ảnh hiện tại (Tick để xóa):</label>
            <div id="edit-room-images" style="display: flex; flex-wrap: wrap; gap: 3px; margin-bottom: 5px;"></div>

            <label class="add-room-label">Upload nhiều ảnh (nếu muốn thay):</label>
            <input type="file" name="new_images[]" id="edit_images_input" multiple>
            <div id="edit-images-preview"
                style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px; justify-content: center;"></div>

            <button type="submit" name="submit" class="btn-add-room">Lưu thay đổi</button>
        </form>
    </div>
</div>

<!-- Popup Filter Modal    -->
<div id="filterModal" class="modal-filter" style="display:none;">
    <div class="modal-filter-content">
        <span class="close-filter" onclick="closeFilterModal()">&times;</span>
        <h3 class="filter-title">Filter Rooms</h3>
        <form method="post" class="filter-form" action="<?= $this->configs->config['basePath'] ?>/admin/rooms">
            <div class="form-group">
                <label class="form-filter">Room Name/Slug</label>
                <input type="text" name="slug" value="<?= htmlspecialchars($_POST['slug'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="form-filter">Room Type</label>
                <select name="id_room_type">
                    <option value="">-- All Types --</option>
                    <option value="1">Standard Room</option>
                    <option value="2">Superior Room</option>
                    <option value="3">Deluxe Room</option>
                    <option value="4">Suite Room</option>
                    <option value="5">Family Room</option>
                    <option value="6">Single Room</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-filter">Status</label>
                <select name="status">
                    <option value="">-- All Status --</option>
                    <option value="available">Available</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-filter">Area (>= m²)</label>
                <input type="number" name="area" min="0" value="<?= htmlspecialchars($_POST['area'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="form-filter">Capacity (>=)</label>
                <input type="number" name="capacity" min="0" value="<?= htmlspecialchars($_POST['capacity'] ?? '') ?>">
            </div>
            <div style="margin-top: 16px; text-align: center;">
                <button type="submit" class="btn btn-filter">Lọc</button>
            </div>
        </form>
    </div>
</div>


<script>
    function openFilterModal() {
        document.getElementById('filterModal').style.display = 'flex';
    }

    function closeFilterModal() {
        document.getElementById('filterModal').style.display = 'none';
    }

    function openAddRoomModal() {
        document.getElementById('addRoomModal').style.display = 'flex';
    }

    function closeAddRoomModal() {
        document.getElementById('addRoomModal').style.display = 'none';
    }

    function openEditRoomModal(room) {
        document.getElementById('edit_id_room').value = room.id_room;
        document.getElementById('edit_slug').value = room.slug || '';
        document.getElementById('edit_name').value = room.name || '';
        document.getElementById('edit_description').value = room.description || '';
        document.getElementById('edit_amount_bed').value = room.amount_bed || '';
        document.getElementById('edit_price').value = room.price || '';
        document.getElementById('edit_status').value = room.status || 'available';
        document.getElementById('edit_area').value = room.area || '';
        document.getElementById('edit_capacity').value = room.capacity || '';
        document.getElementById('edit_id_room_type').value = room.id_room_type || '1';
        document.querySelectorAll('.edit-amenity').forEach(cb => cb.checked = false);
        if (room.amenities) {
            room.amenities.forEach(function(aid) {
                let cb = document.querySelector('.edit-amenity[value="' + aid + '"]');
                if (cb) cb.checked = true;
            });
        }
        // Hiển thị ảnh hiện có
        const imagesDiv = document.getElementById('edit-room-images');
        imagesDiv.innerHTML = '';
        if (room.images && room.images.length > 0) {
            room.images.forEach(function(img) {
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
                // Ảnh
                const image = document.createElement('img');
                image.src = window.BASE_PATH + '/assets' + img.path;
                image.style.width = '100%';
                image.style.height = '100%';
                image.style.objectFit = 'cover';
                // Checkbox xóa
                const del = document.createElement('input');
                del.type = 'checkbox';
                del.name = 'delete_images[]';
                del.value = img.id_image;
                del.style.position = 'absolute';
                del.style.top = '4px';
                del.style.right = '4px';
                del.title = 'Tick để xóa ảnh này';
                imgBox.appendChild(image);
                imgBox.appendChild(del);
                imagesDiv.appendChild(imgBox);
            });
        }
        document.getElementById('editRoomModal').style.display = 'flex';
    }

    function closeEditRoomModal() {
        document.getElementById('editRoomModal').style.display = 'none';
    }

    function deleteRoom(id_room, btn) {
        //Không có xóa được nha. Dính khóa ngoại rồi
        if (!confirm('Bạn có chắc chắn muốn xóa phòng này?')) return;
        fetch('/hotel_booking_online/public/admin/rooms/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id_room=' + encodeURIComponent(id_room)
            })
            .then(res => res.text())
            .then(text => {
                if (text.includes('success')) {
                    location.reload();
                } else {
                    alert('Xóa thất bại!\\n' + text);
                }
            });
    }
    // Preview ảnh khi chọn ở thêm phòng
    document.getElementById('add_images_input')?.addEventListener('change', function(e) {
        const preview = document.getElementById('add-images-preview');
        preview.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
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
        });
    });
    // Preview ảnh khi chọn ở sửa phòng
    document.getElementById('edit_images_input')?.addEventListener('change', function(e) {
        const preview = document.getElementById('edit-images-preview');
        preview.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
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
        });
    });
    window.BASE_PATH = '<?= $this->configs->config["basePath"] ?? "" ?>';
</script>