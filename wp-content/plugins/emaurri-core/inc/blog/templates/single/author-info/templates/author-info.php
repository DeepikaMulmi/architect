<?php
$is_enabled = emaurri_core_get_post_value_through_levels( 'qodef_blog_single_enable_author_info' );

if ( 'yes' === $is_enabled && '' !== get_the_author_meta( 'description' ) ) {
	$author_id     = get_the_author_meta( 'ID' );
	$author_link   = get_author_posts_url( $author_id );
	$email_enabled = 'yes' === emaurri_core_get_post_value_through_levels( 'qodef_blog_single_enable_author_info_email' );
	$user_socials  = emaurri_core_get_author_social_networks( $author_id );
	?>
	<div id="qodef-author-info" class="qodef-m">
		<div class="qodef-m-inner">
			<div class="qodef-m-image">
				<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
					<?php echo get_avatar( $author_id, 260, '', '', array('height' =>'260', 'width' => '240') ); ?>
				</a>
			</div>
			<div class="qodef-m-content">
				<h5 class="qodef-m-author vcard author">
					<span class="qodef-m-author-label"><?php esc_html_e( 'Written by:', 'emaurri-core' ); ?></span>
					<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
						<span class="fn"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
					</a>
				</h5>
				<?php if ( $email_enabled && is_email( get_the_author_meta( 'email' ) ) ) { ?>
					<p itemprop="email" class="qodef-m-email"><?php echo sanitize_email( get_the_author_meta( 'email' ) ); ?></p>
				<?php } ?>
				<p itemprop="description" class="qodef-m-description"><?php echo esc_html( strip_tags( get_the_author_meta( 'description' ) ) ); ?></p>
				<?php if ( ! empty( $user_socials ) ) { ?>
					<div class="qodef-m-social-icons">
						<?php foreach ( $user_socials as $social ) { ?>
                            <?php
                            switch( $social['icon'] ) {

                                case 'social_facebook':
                                    echo '<a itemprop="url" href="' . esc_attr( $social["url"] ) . '" class="' . esc_attr( $social["class"] ) . '" target="_blank">' . esc_html__('Fb.', 'emaurri-core') . '</a>';
                                    break;

                                case 'social_behance':
                                    echo '<a itemprop="url" href="' . esc_attr( $social["url"] ) . '" class="' . esc_attr( $social["class"] ) . '" target="_blank">' . esc_html__('Be.', 'emaurri-core') . '</a>';
                                    break;

                                case 'social_instagram':
                                    echo '<a itemprop="url" href="' . esc_attr( $social["url"] ) . '" class="' . esc_attr( $social["class"] ) . '" target="_blank">' . esc_html__('Ig.', 'emaurri-core') . '</a>';
                                    break;

                                case 'social_twitter':
                                    echo '<a itemprop="url" href="' . esc_attr( $social["url"] ) . '" class="' . esc_attr( $social["class"] ) . '" target="_blank">' . esc_html__('Tw.', 'emaurri-core') . '</a>';
                                    break;

                                case 'social_linkedin':
                                    echo '<a itemprop="url" href="' . esc_attr( $social["url"] ) . '" class="' . esc_attr( $social["class"] ) . '" target="_blank">' . esc_html__('In.', 'emaurri-core') . '</a>';
                                    break;

                                case 'social_pinterest':
                                    echo '<a itemprop="url" href="' . esc_attr( $social["url"] ) . '" class="' . esc_attr( $social["class"] ) . '" target="_blank">' . esc_html__('Pt.', 'emaurri-core') . '</a>';
                                    break;
                            }?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
