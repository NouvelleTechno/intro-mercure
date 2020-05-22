<?php
session_start();
include_once('inc/header.php');
$sql = 'SELECT `chat`.`id`, `chat`.`message`, `chat`.`created_at`, `users`.`pseudo` FROM `chat` LEFT JOIN `users` ON `chat`.`users_id` = `users`.`id` ORDER BY `chat`.`created_at` DESC LIMIT 10;';

// On exécute la requête
$query = $db->query($sql);

// On récupère les données
$messages = $query->fetchAll();

?>
<div class="col-12 my-1">
    <div class="p-2" id="discussion">
        <?php foreach($messages as $message): ?>
            <p><?= $message['pseudo'] ?> a écrit le <?= $message['created_at'] ?> : <?= $message['message'] ?></p>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-12 saisie">
    <div class="input-group">
        <input type="text" class="form-control" id="texte" placeholder="Entrez votre texte">
        <div class="input-group-append">
            <span class="input-group-text" id="valid"><i class="la la-check"></i></span>
        </div>
    </div>
</div>
<?php
include_once('inc/footer.php');
