<?php return '<div id="side-sortables" class="meta-box-sortables"><div id="post_author_meta" class="postbox " >
<button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Contributors</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle"><span>Contributors</span></h2>
<div class="inside">
<div class=\'input-group\'>

    <select class="custom-select" id=\'selector-contributors\'>
        <option value=\'-1\'>Select contributor...</option>
                        <option data-avatar=""value=1>admin</option>
                            <option data-avatar=""value=14>administrator</option>
                            <option data-avatar=""value=15>author</option>
                            <option data-avatar=""value=16>contributor</option>
                            <option data-avatar=""value=17>subscriber</option>
                        </select>
    <button type="button" class="button tag-add" id="add-contributor">Add</button>
</div>
<ul class=\'contributors-list\' id=\'editable-contributors-list\'>
                            <li data-id=1>
                    <span class="contributor-nickname">admin</span>
                    <input type="hidden" name=wp_contributors_plugin_value[] value=1>
                    <span class=\'fo fo-close\' >
                </li>
         
       
</ul></div>
</div>
</div>';
