<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Update: <?php echo $data['title']; ?></h1>

<?php if ($data['image']): ?>
    <img width="200" src="<?= $data['image'] ?>" >
<?php endif; ?>

<form action="/blog/update?<?php echo $data['url']; ?>" method="post" enctype="multipart/form-data">
    <p>
        <label>Редактирование заголовка: </label>
        <input type="text" name="title" value="<?php echo $data['title']; ?>"><Br>
        <label>Добавить картинку: </label>
        <input type="file" name="image"><Br>
        <label>Редактирование ткста: </label>
        <textarea name="content"><?php echo $data['content']; ?></textarea></p>
    <p><input type="submit"></p>
</form>

<a href="javaScript:void(0)" onclick="clickMe('<?= $data['image'] ?>')">click</a>

<script>
    $( document ).ready(function() {

    });

    function clickMe(urlImage) {
        $.ajax({
            method: "POST",
            url: "/blog/ajax",
            data: { urlImage: urlImage }
        })
        .done(function( msg ) {
            console.log( "Data Saved: " + msg );
        });
    }


</script>