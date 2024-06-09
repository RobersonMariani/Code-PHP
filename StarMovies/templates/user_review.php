<?php
if ($review->user->getImage() == "") {
    $review->user->setImage("user.png");
}
?>

<div class="col-md-12 review">
    <div class="row">
        <div class="col-md-1">
            <div class="profile-image-container" style="background-image:url('<?= $BASE_URL ?>img/users/<?= $review->user->getImage() ?>')"></div>
        </div>
        <div class="col-md-9 author-details-container">
            <h4 class="author-name">
                <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->user->getId() ?>"><?= $review->user->getFullname() ?></a>
            </h4>
            <p><i class="fas fa-star"> <?= $review->getRating() ?></i></p>
        </div>
        <div class="col-md-12">
            <p class="comments-title">Comentário:</p>
            <p><?= $review->getReview() ?></p>
        </div>
    </div>
</div>