<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 my-5 d-flex justify-content-between align-items-center">
            <div class="">
                <h2>Articles</h2>
            </div>
            <div class=""><a href="/articles/create" class="btn btn-primary">Create</a></div>
        </div>
        <?php foreach($articles as $article): ?>
        <div class="col-md-8 mx-auto card mb-2">
            <div class="card-header">
                <h5><?= $article['title']; ?></h5>
            </div>
            <div class="card-body">
                <p class="text-muted"><?= $article['content']; ?></p>
            </div>
            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="<?= "/articles/edit/{$article['id']}" ?>" class="btn btn-success btn-sm">Edit</a>
                <form action="<?= "/articles/delete/{$article['id']}" ?>" method="POST">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
