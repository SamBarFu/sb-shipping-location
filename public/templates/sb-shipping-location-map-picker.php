<?php 
/**
 * Template shipping location map picker 
 * 
 */

 ?>
<div class="sb-hidden-fields-location">
    <input type="hidden" name="sbsl_location_map_default_lat" id="sbsl_location_map_default_lat" value="9.972829442">
    <input type="hidden" name="sbsl_location_map_default_lng" id="sbsl_location_map_default_lng" value="-83.85249659">
    <input type="hidden" name="sbsl_auto_detect_user_location" id="sbsl_auto_detect_user_location" value="yes">
</div>
<div class="section sbsl-shipping-location-checkout">
    <h4 class="sg-del-add-title"><?php esc_html_e('Seleccione una ubicación de envio', 'woocommerce-location-location-map-picker'); ?></h4>

    <a id="sbsl-show-map-picker-button" class="sb-button button-black">Seleccionar ubicación</a>

    <div id="map-picker-container" class="map-picker-container">
        <div id="sbsl_location_picker_map" class="map-picker"></div>
        <div class="sb-notify error out-of-cover"></div>
        <div class="sbsl-location-address-container sbsl-input-group">
            <label for="<?php echo esc_attr('sbsl_location_new_address'); ?>" class="sbsl-input-label required">
                <?php esc_html_e('Dirección','sbsl'); ?>
            </label>
            <input 
                type="text" 
                name="sbsl_location_new_address"  
                id="sbsl_location_new_address" 
                required 
                data-clear="true"
                class="sbsl-input"
                required="<?php echo esc_attr('require') ?>"
            >
            <input 
                type="hidden" 
                name="<?php echo esc_attr('sbsl_location_address_new_lat'); ?>" 
                id="<?php echo esc_attr('sbsl_location_address_new_lat'); ?>" data-clear="true"
            >
            <input 
                type="hidden" 
                name="<?php echo esc_attr('sbsl_location_address_new_lng'); ?>" 
                id="<?php echo esc_attr('sbsl_location_address_new_lng'); ?>" data-clear="true"
            >
            <span class="sg-error"></span>
        </div>

        <div class="sbsl-location-options-container">

            <!-- <div class="sbsl-option-area sbsl-input-group">
                <label class="sbsl-input-label" for="<?php //echo esc_attr('sbsl_location_new_area'); ?>">
                    <?php //esc_html_e('Area', 'sbsl'); ?>
                </label>
                <input 
                    type="text" 
                    name="<?php //echo esc_attr('sbsl_location_new_area'); ?>" 
                    id="<?php //echo esc_attr('sbsl_location_new_area'); ?>" 
                    data-clear="true"
                    class="sbsl-input"
                >
                <input 
                    type="hidden" 
                    name="<?php //echo esc_attr('sbsl_location_new_area'); ?>" 
                    id="<?php //echo esc_attr('sbsl_location_new_area'); ?>" 
                    data-clear="true"
                >
            </div>    -->      

            <div class="sbsl-option-flat-no sbsl-input-group">
                <label class="sbsl-input-label" for="<?php echo esc_attr('sbsl_location_new_flat_no'); ?>">
                    <?php esc_html_e('Casa/Unidad/Piso/Etc ', 'sbsl'); ?>
                </label>
                <input 
                    type="text" 
                    name="<?php echo esc_attr('sbsl_location_new_flat_no'); ?>" 
                    id="<?php echo esc_attr('sbsl_location_new_flat_no'); ?>" 
                    data-clear="true"
                    class="sbsl-input"
                >
                <!-- <input 
                    type="hidden" 
                    name="<?php //echo esc_attr('sbsl_location_new_flat_no'); ?>" 
                    id="<?php //echo esc_attr('sbsl_location_new_flat_no'); ?>" 
                    data-clear="true"
                > -->
            </div>                            
        </div>
        <label id="sbsl-select-location-button" class="sb-button button-black">Usar esta Dirección</label>
        <label id="sbsl-close-select-location-button" class="sb-button button-red">Cancelar</label>
    </div>
</div>