<?php
/*
 Plugin Name: twitter:creator
 Plugin URI: https://github.com/pfefferle/twitter-creator
 Description: Adds the twitter:creator meta-tag but no other twitter-card stuff... please use OpenGraph instead!
 Author: pfefferle
 Author URI: http://notizblog.org/
 Version: 1.0.0
*/

// add "twitter" as a contact method
function twitter_creator_add_user_contactmethods($user_contactmethods) {
  $user_contactmethods['twitter'] = __("Twitter Username (without '@')");
  return $user_contactmethods;
}
add_filter("user_contactmethods", "twitter_creator_add_user_contactmethods", 1);

// adds the "twitter:creator" meta-tag
function twitter_creator_add_header() {
  if ( is_singular() ) {
    global $post;
    $author = $post->post_author;
    if ($author && $twitter = get_the_author_meta( 'twitter', $author ))
      echo '<meta name="twitter:creator" content="@'.$twitter.'" />'."\n";
  }
  
  echo '<meta name="twitter:card" content="summary" />'."\n";
}
add_action("wp_head", "twitter_creator_add_header");
