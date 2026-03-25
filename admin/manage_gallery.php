<?php include 'includes/admin_header.php'; 

// Add Gallery Item
if (isset($_POST['add_gallery']) && $conn) {
    $image_url = sanitize($_POST['image_url']);
    $caption = sanitize($_POST['caption']);
    $category = sanitize($_POST['category']);

    $stmt = $conn->prepare("INSERT INTO gallery (image_url, caption, category) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $image_url, $caption, $category);
    $stmt->execute();
    header("Location: manage_gallery.php?msg=Image Added");
    exit();
}

// Delete Image
if (isset($_GET['delete']) && $conn) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM gallery WHERE id = $id");
    header("Location: manage_gallery.php?msg=Deleted");
    exit();
}

$gallery = ($conn) ? $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC") : null;
?>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-sm);" class="reveal">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3>Gallery Management</h3>
        <button onclick="document.getElementById('add_modal').style.display='flex'" class="btn btn-primary" style="font-size: 0.85rem;"><i class="fas fa-plus"></i> Add New Image</button>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem;">
        <?php if($gallery && $gallery->num_rows > 0): ?>
            <?php while($row = $gallery->fetch_assoc()): ?>
            <div style="position: relative; border-radius: 10px; overflow: hidden; height: 180px; box-shadow: var(--shadow-sm); border: 1px solid #e2e8f0;">
                <img src="<?php echo $row['image_url']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(0,0,0,0.7); color: white; padding: 0.5rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem;">
                    <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px;"><?php echo $row['caption']; ?></span>
                    <a href="?delete=<?php echo $row['id']; ?>" style="color: #ef4444;" onclick="return confirm('Delete this image?');"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 3rem;">No images uploaded to gallery.</p>
        <?php endif; ?>
    </div>

    <div id="add_modal" style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 2000;">
        <div style="background: white; border-radius: 16px; width: 500px; padding: 3rem; position: relative;">
            <a href="#" onclick="document.getElementById('add_modal').style.display='none'" style="position: absolute; top: 1.5rem; right: 1.5rem; font-size: 1.5rem; color: var(--text-muted);"><i class="fas fa-times"></i></a>
            <h2 style="margin-bottom: 2rem; color: var(--primary);">Add Gallery Image</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Image URL</label>
                    <input type="text" name="image_url" class="form-control" placeholder="https://..." required>
                </div>
                <div class="form-group">
                    <label>Caption</label>
                    <input type="text" name="caption" class="form-control" placeholder="Description of image">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" class="form-control">
                        <option value="Activities">Activities</option>
                        <option value="Sports">Sports</option>
                        <option value="Events">Events</option>
                        <option value="Campus">Campus</option>
                    </select>
                </div>
                <button type="submit" name="add_gallery" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Upload Gallery Item</button>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
