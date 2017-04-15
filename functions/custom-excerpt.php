<?php
//better wordpress excert
function better_excerpts(
        $words = 40,
        $link_text = 'Continue reading this entry &#187;',
        $allowed_tags = '',
        $container = '', $smileys = 'no'
)
{
global $post;
if ( $allowed_tags == 'all' ) $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<span>,<blockquote>,<img>';
$text = preg_replace('/([*]|\[(.*?)\])/', '', strip_tags($post->post_content, $allowed_tags));
$text = explode(' ', $text);
 $text = str_replace('\]\]\>', ']]&gt;', $text);
$tot = count($text);
for ( $i=0; $i<$words; $i++ ) : $output .= $text[$i] . ' '; endfor;
if ( $smileys == "yes" ) $output = convert_smilies($output);
?><p><?php echo force_balance_tags($output) ?><?php if ( $i < $tot ) : ?> ...<?php else : ?></p><?php endif; ?>
<?php if ( $i < $tot ) :
if ( $container == 'p' || $container == 'div' ) : ?></p><?php endif;
if ( $container != 'plain' ) : ?><?php echo $container; ?><?php if ( $container == 'div' ) : ?><p><?php endif; endif; ?>
<? if(is_home()){  ?>
<div class="readmore-link"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $link_text; ?></a></div>
<?php } else { ?>
  <div class="readmore-link-text"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $link_text; ?></a></div>

<?php } ?>
<?php
if ( $container == 'div' ) : ?></p><?php endif; if ( $container != 'plain' ) : ?></<?php echo $container; ?>><?php endif;
if ( $container == 'plain' || $container == 'span' ) : ?></p><?php endif;
endif;
}
?>
