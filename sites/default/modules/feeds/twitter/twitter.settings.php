<?php
// path to this installations include directory
define('INCLUDE_DIR', '/inetpub/ocdla/html/includes');

define('SETTINGS_DIR', '/inetpub/ocdla/html/sites/ocdla');

// the name of the twitter feed to retrieve
define('TWITTER_FEED_NAME', 'OregonDefense');

// set to false to disable MySQL caching of Twitter results
define('TWITTER_CACHE_USE_CACHE', FALSE);

// location of twitter cache files
define( 'TWITTER_CACHE_DIR', CACHE_DIR. '/twitter');

define('TWITTER_LINKS_USE_TWITTER_HOME', TRUE);
define('TWITTER_LOAD_FROM_LOCAL_FILE', TRUE);
// set to false to show Twitter Direct Messages
define('TWITTER_HIDE_DM', TRUE);
// time in minutes after which the data in the Twitter cache will be deemed expired
define('TWITTER_CACHE_EXPIRE',5);
// number of tweets to display
define('TWITTER_FEED_LIMIT',2);

// define types of twitter renders so we pull the correct render version
// from the database
define('TWITTER_RENDER_LEFT_SIDEBAR', 23);
define('TWITTER_RENDER_RIGHT_SIDEBAR', 35);
define('TWITTER_RENDER_FRONT_PAGE', 42);
define('TWITTER_RENDER_DEFAULT', 42);