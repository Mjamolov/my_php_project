<?php
include_once __DIR__ . "/../header.php"
?>
    <h1> Create Product</h1>

    <div>
        <a class="btn btn-warning"
           href="http://localhost/php/Shop(stream13)/backend/index.php?model=product&action=read"> К списку</a>
    </div>
    <div>
        <form action="http://localhost/php/Shop(stream13)/backend/index.php?model=product&action=save" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $oneProduct['id'] ?? '' ?>"/>
            <div class="form-group">
                <label>Title</label>
                <input type="text" value="<?= $oneProduct['title'] ?? '' ?>" name="title" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Picture</label>
                <input type="file" name="picture" class="form-control"/>
                <?php
                if (!empty($oneProduct['picture'])) {
                    ?>
                    <img src="/php/Shop(stream13)/uploads/<?php echo $oneProduct['picture']; ?>" style="width: 70px">
                    <?php
                }
                ?>
            </div>
            <div class="form-group">
                <label>Preview</label>
                <input type="text" value="<?= $oneProduct['preview'] ?? '' ?>" name="preview" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input name="price" value="<?= $oneProduct['price'] ?? '' ?>" type="number" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Status</label>
                <input name="status" value="<?= $oneProduct['status'] ?? '' ?>" type="number" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea rows="7" name="content" class="form-control"> <?= $oneProduct['content'] ?? '' ?> </textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
<?php
include_once __DIR__ . "/../footer.php"
?>