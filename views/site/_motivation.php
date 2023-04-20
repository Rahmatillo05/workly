<?php

use yii\helpers\Url; ?>
<div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-sm-7">
            <div class="card-body">
                <h5 class="card-title text-primary">Welcome back! 🎉</h5>
                <figure class="mt-2">
                    <blockquote class="blockquote" id="motiv-text">
                        <p class="mb-0"></p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Author: <cite id="motiv-author" title="Source author"></cite>
                    </figcaption>
                </figure>
            </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
                <img
                    src="<?= Url::base() ?>/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                />
            </div>
        </div>
    </div>
</div>
