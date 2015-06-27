<?php
/**
 * @package Mean_Girls
 * @version 1.1
 */
/*
Plugin Name: WP Mean Girls
Plugin URI: http://thomasjones.me/wp/plugins/mean-girls
Description: When activated you will randomly see a quote from Mean Girls (2004) in the upper right of your admin screen on every page.
Author: Thomas Jones
Version: 1.1
Author URI: http://thomasjones.me

Copyright 2014 Thomas Jones

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function mean_girls_get_quote() {
	$quotes = "If you're from Africa, why are you white?
Oh my God, Karen, you can't just ask people why they're white.
I can't go out. I'm sick.
Boo, you whore!
Why are you dressed so scary?
Don't have sex, because you will get pregnant and die!
Get in loser, we're going shopping.
I'm sorry that people are so jealous of me... but I can't help it that I'm so popular.
Janis, I cannot stop this car. I have a curfew.
You're plastic. Cold, shiny, hard plastic.
It's not my fault you're like, in love with me, or something!
Why were you talking to Janis Ian?
Regina George is flawless.
I hear her hair's insured for $10,000.
I hear she does car commercials... in Japan.
Her favorite movie is Varsity Blues.
She is one of the dumbest girls you will ever meet.
She asked me how to spell orange.
That little one, that's Gretchen Wieners.
She's totally rich because her dad invented Toaster Streudels.
That's why her hair is so big, it's full of secrets.
She's the queen bee - the star, those other two are just her little workers.
Hey, you guys! Happy hour is from four to six!
Um, is there alcohol in this?
She's fabulous, but she's evil.
Is your muffin buttered?";

	// Here we split it into lines
	$quotes = explode( "\n", $quotes );

	// And then randomly choose a line
	return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function mean_girls() {
	$chosen = mean_girls_get_quote();
	echo "<p id='mean'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'mean_girls' );

// We need some CSS to position the paragraph
function mean_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#mean {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'mean_css' );

?>
