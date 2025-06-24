<pre>
<?php print_r($data); ?></pre>




<form method="post" enctype="multipart/form-data" action="<?= $this->configs->config['basePath'] ?>/admin/rooms/add">
    <label>Slug:</label>
    <input type="text" name="slug" required><br>

    <label>Price:</label>
    <input type="number" name="price" required><br>

    <label>Description:</label>
    <textarea name="description" rows="4" cols="50"></textarea><br>

    <label>Status:</label>
    <select name="status" required>
        <option value="available">Available</option>
        <option value="maintenance">Maintenance</option>
    </select><br>

    <label>Area (m²):</label>
    <input type="number" name="area" required><br>

    <label>Capacity (người):</label>
    <input type="number" name="capacity" required><br>

    <label>Room type:</label>
    <select name="id_room_type" required>
        <option value="1">Standard Room</option>
        <option value="2">Superior Room</option>
        <option value="3">Deluxe Room</option>
        <option value="4">Suite Room</option>
        <option value="5">Family Room</option>
        <option value="6">Single Room</option>
    </select><br>

    <label>Chọn tiện nghi (Amenity):</label><br>
    <input type="checkbox" name="amenities[]" value="1"> Wi-Fi<br>
    <input type="checkbox" name="amenities[]" value="2"> TV<br>
    <input type="checkbox" name="amenities[]" value="3"> Máy lạnh<br>
    <input type="checkbox" name="amenities[]" value="4"> Mini bar<br>
    <input type="checkbox" name="amenities[]" value="5"> Bồn tắm<br>

    <label>Upload nhiều ảnh:</label><br>
    <input type="file" name="images[]" multiple required><br><br>

    <button type="submit" name="submit">Thêm phòng</button>
</form>