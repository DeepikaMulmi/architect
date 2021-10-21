<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-content" <?php qode_framework_inline_style( $text_style ); ?>>
		<div class="qodef-m-text qodef-text--original">
			<?php if ( ! empty( $text_1 ) ) { ?>
				<span class="qodef-m-text--1" <?php qode_framework_inline_style( $text_individual_style['first'] ); ?>>
					<?php echo esc_html( $text_1 ); ?>
				</span>
			<?php }
			if ( ! empty( $text_2 ) ) { ?>
				<span class="qodef-m-text--2" <?php qode_framework_inline_style( $text_individual_style['second'] ); ?>>
					<?php echo esc_html( $text_2 ); ?>
				</span>
			<?php }
			if ( ! empty( $text_3 ) ) { ?>
				<span class="qodef-m-text--3" <?php qode_framework_inline_style( $text_individual_style['third'] ); ?>>
					<?php echo esc_html( $text_3 ); ?>
				</span>
			<?php } ?>
		</div>
		<div class="qodef-m-text qodef-text--copy">
			<?php if ( ! empty( $text_1 ) ) { ?>
				<span class="qodef-m-text--1" <?php qode_framework_inline_style( $text_individual_style['first'] ); ?>>
				<?php echo esc_html( $text_1 ); ?>
				</span>
			<?php }
			if ( ! empty( $text_2 ) ) { ?>
				<span class="qodef-m-text--2" <?php qode_framework_inline_style( $text_individual_style['second'] ); ?>>
				<?php echo esc_html( $text_2 ); ?>
				</span>
			<?php }
			if ( ! empty( $text_3 ) ) { ?>
				<span class="qodef-m-text--3" <?php qode_framework_inline_style( $text_individual_style['third'] ); ?>>
					<?php echo esc_html( $text_3 ); ?>
				</span>
			<?php } ?>
		</div>
	</div>
</div>
