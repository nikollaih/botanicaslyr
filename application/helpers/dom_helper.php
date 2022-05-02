<?php

//TODO ================= PERSONS DOM FUNCTIONS ==================== //
/**
 * Select options for document types
 */
function document_types_options($selected = '-1'){
	$CI = & get_instance();  //get instance, access the CI superobject
    $CI->load->model("Mdl_DocumentType");

    $docs = $CI->Mdl_DocumentType->getDocumentTypes();
    
    $dom_docs = "<option value='-1'>-- Seleccione un tipo de documento</option>";

    if ($docs != false) {
    	foreach ($docs as $doc) {
    		$active = "";
    		if ($selected == $doc['id_tipo_documento']) {
    			$active = "selected";
    		}

    		$dom_docs .= "<option ".$active." value='".$doc['id_tipo_documento']."'>".$doc['descripcion_tipo_documento']."</option>";
    	}
    }

    echo $dom_docs;
}
//TODO ================= END PERSONS DOM FUNCTIONS ==================== //


//TODO ================= PRODUCTS DOM FUNCTIONS ==================== //
/**
 *  Select options for product categories
 */
function product_categories_options($selected = '-1'){
	$CI = & get_instance();  //get instance, access the CI superobject
    $CI->load->model('Mdl_ProductCategories');

    $cat = $CI->Mdl_ProductCategories->all();
    
    $dom_cat = "<option value='-1'>-- Seleccione una categoría</option>";

    if ($cat != false) {
    	foreach ($cat as $c) {
    		$active = "";
    		if ($selected == $c['id_producto_categorias']) {
    			$active = "selected";
    		}

    		$dom_cat .= "<option ".$active." value='".$c['id_producto_categorias']."'>".$c['descripcion_producto_categorias']."</option>";
    	}
    }

    echo $dom_cat;
}

/**
 *  Select options for product states
 */
function product_states_options($selected = '-1'){
	$CI = & get_instance();  //get instance, access the CI superobject
    $CI->load->model('Mdl_ProductStates');

    $cat = $CI->Mdl_ProductStates->all();
    
    $dom_cat = "<option value='-1'>-- Seleccione un estado</option>";

    if ($cat != false) {
    	foreach ($cat as $c) {
    		$active = "";
    		if ($selected == $c['id_estado_productos']) {
    			$active = "selected";
    		}

    		$dom_cat .= "<option ".$active." value='".$c['id_estado_productos']."'>".$c['descripcion_estado_productos']."</option>";
    	}
    }

    echo $dom_cat;
}
//TODO ================= END PRODUCTS DOM FUNCTIONS ==================== //