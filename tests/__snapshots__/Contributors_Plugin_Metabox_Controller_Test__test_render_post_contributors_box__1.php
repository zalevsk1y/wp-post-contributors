<?php return '<div class=\'input-group\'>

    <select class="custom-select" id=\'selector-contributors\'>
        <option value=\'-1\'>Select contributor...</option>
                        <option data-avatar=""value=1>admin</option>
                            <option data-avatar=""value=6>administrator</option>
                            <option data-avatar=""value=7>author</option>
                            <option data-avatar=""value=8>contributor</option>
                            <option data-avatar=""value=9>subscriber</option>
                        </select>
    <button type="button" class="button tag-add" id="add-contributor">Add</button>
</div>
<ul class=\'contributors-list\' id=\'editable-contributors-list\'>
                            <li data-id=1>
                    <span class="contributor-nickname">admin</span>
                    <input type="hidden" name=wp_contributors_plugin_value[] value=1>
                    <span class=\'fo fo-close\' >
                </li>
                        <li data-id=6>
                    <span class="contributor-nickname">administrator</span>
                    <input type="hidden" name=wp_contributors_plugin_value[] value=6>
                    <span class=\'fo fo-close\' >
                </li>
         
       
</ul>';
