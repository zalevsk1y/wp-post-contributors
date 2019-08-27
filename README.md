
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zalevsk1y/wp-post-contributors/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zalevsk1y/wp-post-contributors/?branch=master)  [![Code Coverage](https://scrutinizer-ci.com/g/zalevsk1y/wp-post-contributors/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/zalevsk1y/wp-post-contributors/?branch=master)  [![Build Status](https://scrutinizer-ci.com/g/zalevsk1y/wp-post-contributors/badges/build.png?b=master)](https://scrutinizer-ci.com/g/zalevsk1y/wp-post-contributors/build-status/master)

# Wordpress Plugin wp-post-contributors 
Here is the [link](https://github.com/zalevsk1y/wp-post-contributors-wpcs) to the same plugin, but wrote follow WP Coding Standards.
This plugin follows the PSR standard. I think that you shouldn`t follow Wordpress Coding Standards unless you’re doing core development. And here are my arguments:
*   To date, over 60 plugins have been created and not using namespase is not possible. And to use the namespace other then PSR-4 standard is very unnatural for me :smile:.
*   I am a fullstack developer and use the camelCase  for me very comfortable, camelCase easier to read, takes up less space and looks less out of place among code.
*   IMHO if you’re writing modern PHP, I think the following WPCS will lead to code of a lower quality.

The plugin allows you to select users from the list and mark them as post-contributors. After saving, data about the contributors will be displayed at the bottom of the post. You can use the `contributors_plugin_post_template` filter
which allows you to change the path to the template. This will be useful when using this plugin with various themes.

### Features

*   Clean Design
*   Easy customizable

### Installing

1. You can clone the GitHub repository: `https://github.com/zalevsk1y/wp-post-contributors.git`
2. Or download it directly as a ZIP file: `https://github.com/zalevsk1y/wp-post-contributors/archive/master.zip`

This will download the latest developer copy of wp-post-contributors.

## How to use NewsParserPlugin\this plugin?

Select from dropdown list of registered users, one or several users in "Contributors" metabox and save the post. Get to the post preview page and you will see user marked by you as contributors at the bottom of the post.
If you would like delete user from contributor list enter to the 'Edit Post' section and press cross in front of user nickname in 'Contributor' metabox. That will remove user name from the contributors list.Save your post. And check out changes at preview page :smile:. 


## Bugs ##

If you find an issue, let us know [here](https://github.com/zalevsk1y/wp-post-contributors/issues?state=open)!