<?php
session_start();
include_once('inc/header.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT messages.*, users.pseudo as expediteur FROM messages LEFT JOIN users ON messages.exp_id = users.id WHERE messages.id = :id';

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $message = $query->fetch();

    if(!$message) header('Location: /index.php');

    $sql = 'UPDATE messages SET unread = 0 WHERE id = '.$message['id'];

    $query = $db->query($sql);
}
?>
<div class="col-12 my-1 d-flex justify-content-between">
    <h1>Votre message</h1>
    <p><a class="btn btn-primary" href="newmessage.php?user=<?= $message['exp_id'] ?>">Répondre</a></p>
</div>
<div class="col-12">
    <p>Message de <?= $message['expediteur'] ?> le <?= $message['created_at'] ?></p>
    <div>Message : <?= $message['message'] ?></div>
    <p><a href="messagerie.php" class="btn btn-success" title=""><i class="la la-arrow-left"></i></a><a href="#" class="btn btn-danger" title="supprimer"><i class="la la-minus"></i></a></p>
</div>
<?php
include_once('inc/footer.php');
