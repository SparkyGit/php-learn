<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article['name'] ?></h1>
    <p><?= $article['text'] ?></p>
    <p>Статью написал: <?= $author ?></p>
<?php include __DIR__ . '/../footer.php'; ?>