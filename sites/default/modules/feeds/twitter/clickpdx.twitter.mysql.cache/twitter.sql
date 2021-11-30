/**
 * SQL file to create a twitter cache table
 */
 
create table twitter (cache_time int not null, twitter_html text, feed_length int, primary key(cache_time));