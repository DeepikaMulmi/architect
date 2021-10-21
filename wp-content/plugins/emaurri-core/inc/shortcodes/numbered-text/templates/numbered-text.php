<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <?php emaurri_core_template_part( 'shortcodes/numbered-text', 'templates/parts/number', '', $params ) ?>
    <div class="qodef-m-content">
	    <?php emaurri_core_template_part( 'shortcodes/numbered-text', 'templates/parts/title', '', $params ) ?>
	    <?php emaurri_core_template_part( 'shortcodes/numbered-text', 'templates/parts/text', '', $params ) ?>
	    <?php emaurri_core_template_part( 'shortcodes/numbered-text', 'templates/parts/button', '', $params ) ?>
    </div>
</div>