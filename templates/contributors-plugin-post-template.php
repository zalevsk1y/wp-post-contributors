<?php if(isset($contributors)): ?>
    <div class='contributors-post-container'>
        <h4><?php echo esc_html__('Contributors') ?></h4>
        <ul class='contributors-post-list'>
            <?php foreach($contributors as $contributor): ?>
                <li class='contributors-list-item'>
                    <?php echo $contributor->avatar_tag ?>
                    <a href='<?php echo esc_url($contributor->link) ?>'>
                        <span calss='contributors-post-nickname'><?php echo esc_html($contributor->nickname) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>