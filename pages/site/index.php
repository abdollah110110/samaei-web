<div class="jumbotron d-flex flex-column align-items-center">
        <h1><?= Html::title() ?></h1>
        <p><?= Html::description() ?></p>
</div>
<?php
$posts = (new Posts() ) -> findFields( [
                'id', 'title', 'image', 'abstract', 'view', 'created_at'
        ] ) -> where( [
                        [ 'active', '=', 1 ],
        ] ) -> query();
?>
<?php
require_once Html::basePath( 'includes\views\\show-posts.php' );
?>