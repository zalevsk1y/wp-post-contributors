<div class='input-group'>

    <select class="custom-select" id='selector-contributors'>
        <option value='-1'>Select contributor...</option>
        <?php if(isset($authors)&&count($authors)>0): 
            foreach($authors as $author): ?>
                <option data-avatar="<?php  ?>"value=<?php echo esc_html($author->ID)?>><?php echo esc_html($author->nickname)?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <button type="button" class="button tag-add" id="add-contributor">Add</button>
</div>
<ul class='contributors-list' id='editable-contributors-list'>
<?php if(isset($contributors)):?>
            <?php foreach($contributors as $key=>$contributor): ?>
                <li data-id=<?php echo esc_html($contributor->ID)?>>
                    <span class="contributor-nickname"><?php echo esc_html($contributor->nickname) ?></span>
                    <input type="hidden" name=<?php echo CONTRIBUTORS_PLUGIN_INPUT_FIELD ?> value=<?php echo esc_html($contributor->ID)?>>
                    <span class='fo fo-close' >
                </li>
        <?php endforeach; ?> 
       
<?php endif; ?>
</ul>