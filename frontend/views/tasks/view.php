<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
?>

<section class="content-view">
    <div class="content-view__card">
        <div class="content-view__card-wrapper">
        <div class="content-view__header">
            <div class="content-view__headline">
            <h1><?= Html::encode($tasks['name']); ?></h1>
            <span>Размещено в категории
                <a href="<?= Url::to(['tasks/index', 'TasksForm'=>['category' => $tasks['category_id']]]) ?>"
                class="link-regular">
                    <?= Html::encode($tasks->category->name); ?>
                </a>
                <?= Yii::$app->formatter->asRelativeTime(Html::encode($tasks->date_add)); ?>
            </span>
            </div>
            <b class="new-task__price new-task__price--clean content-view-price">
                <?= Html::encode($tasks->budget); ?><b> ₽</b>
            </b>
            <div class="new-task__icon new-task__icon--<?= Html::encode($tasks->category->icon); ?> content-view-icon">
            </div>
        </div>
        <div class="content-view__description">
            <h3 class="content-view__h3">Общее описание</h3>
            <p><?= Html::encode($tasks->description); ?></p>
        </div>
        <div class="content-view__attach">
            <h3 class="content-view__h3">Вложения</h3>
            <?php if(!empty($clips)) : ?>
                <?php foreach($clips as $clip) : ?>
                    <a href="<?= Url::to("@web/img/{$clip['path']}"); ?>"><?= $clip['path']; ?></a>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Отсутствуют</p>
            <?php endif; ?>
        </div>
        <div class="content-view__location">
            <h3 class="content-view__h3">Расположение</h3>
            <div class="content-view__location-wrapper">
            <div class="content-view__map">
                <a href="#"><img src="../img/map.jpg" width="361" height="292"
                                alt="Москва, Новый арбат, 23 к. 1"></a>
            </div>
            <div class="content-view__address">
                <span class="address__town">Москва</span><br>
                <span>Новый арбат, 23 к. 1</span>
                <p>Вход под арку, код домофона 1122</p>
            </div>
            </div>
        </div>
        </div>
        <div class="content-view__action-buttons">
        <button class=" button button__big-color response-button open-modal"
                type="button" data-for="response-form">Откликнуться
        </button>
        <button class="button button__big-color refusal-button open-modal"
                type="button" data-for="refuse-form">Отказаться
        </button>
        <button class="button button__big-color request-button open-modal"
                type="button" data-for="complete-form">Завершить
        </button>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отклики <span>(<?= count($responds); ?>)</span></h2>

        <div class="content-view__feedback-wrapper">
            <?php foreach($responds as $respond) : ?>
                <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                    <a href="<?= Url::to(['users/user', 'id' => $respond->executor->id]) ?>">
                        <?= Html::img("@web/{$respond->executor->path}", ['width' => 55, 'height' => 55]) ?>
                    </a>
                    <div class="feedback-card__top--name">
                        <p>
                            <a href="<?= Url::to(['users/user', 'id' => $respond->executor->id]) ?>"
                            class="link-regular">
                                <?= Html::encode($respond->executor->name); ?>
                            </a>
                        </p>
                        <?php $average_rating = $respond->executor->getAverageRating(); ?>
                        <?php if ($average_rating >= 1
                        && $average_rating < 2) : ?>
                            <span></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                        <?php elseif ($average_rating >= 2
                        && $average_rating < 3) : ?>
                            <span></span>
                            <span></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                        <?php elseif ($average_rating >= 3
                        && $average_rating < 4) : ?>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                        <?php elseif ($average_rating >= 4
                        && $average_rating < 5) : ?>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span class="star-disabled"></span>
                        <?php elseif ($average_rating >= 5) : ?>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        <?php else : ?>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                            <span class="star-disabled"></span>
                        <?php endif; ?>

                        <b><?= Html::encode($average_rating); ?></b>
                    </div>
                    <span class="new-task__time">
                        <?= Yii::$app->formatter->asRelativeTime(Html::encode($respond->date)); ?>
                    </span>
                    </div>
                    <div class="feedback-card__content">
                    <p><?= Html::encode($respond->comment); ?></p>
                    <span><?= Html::encode($respond->budget); ?> ₽</span>
                    </div>
                    <div class="feedback-card__actions">
                    <a class="button__small-color response-button button"
                        type="button">Подтвердить</a>
                    <a class="button__small-color refusal-button button"
                        type="button">Отказать</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__profile-mini">
        <div class="profile-mini__wrapper">
        <h3>Заказчик</h3>
        <div class="profile-mini__top">
            <?= Html::img("@web/{$tasks->creator->path}", ['width' => 55, 'height' => 55, 'alt' => 'Аватар заказчика']) ?>
            <div class="profile-mini__name five-stars__rate">
            <p><?= Html::encode($tasks->creator->name); ?></p>
            </div>
        </div>
        <p class="info-customer">
        <span>
            <?= Yii::t(
                'app',
                '{n, plural,
                    =0{# заданий}
                    =1{# задание}
                    one{# задание}
                    few{# задания}
                    many{# заданий}
                    other{# задания}}',
                ['n' => $tasksCount]
            ); ?>
        </span>
        <span class="last-">
            <?php
                if ($result_time < 365) {
                    echo Yii::t(
                        'app',
                        '{n, plural,
                            =0{# дней}
                            =1{# день}
                            one{# день}
                            few{# дня}
                            many{# дней}
                            other{# дня}}',
                        ['n' => $result_time]
                    );
                } elseif ($result_time > 364) {
                    echo Yii::t(
                        'app',
                        '{n, plural,
                            =0{# лет}
                            =1{# год}
                            one{# год}
                            few{# года}
                            many{# лет}
                            other{# года}}',
                        ['n' => floor($result_time/365)]
                    );
                }
            ?>
            на сайте
        </span></p>
        <!-- <a href="#" class="link-regular">Смотреть профиль</a> -->
        </div>
    </div>
    <div id="chat-container">
        <!--добавьте сюда атрибут task с указанием в нем id текущего задания-->
        <div class="connect-desk__chat">
            <h3>Переписка</h3>
            <div class="chat__overflow"></div>
            <p class="chat__your-message">Ваше сообщение</p>
            <form class="chat__form">
                <textarea rows="2" name="message-text" placeholder="Текст сообщения"
                class="input textarea textarea-chat"></textarea>
                <button type="button" class="button chat__button">Отправить</button>
            </form>
        </div>
    </div>
</section>
