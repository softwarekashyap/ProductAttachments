/* global $, $K */

define([
    'mage/adminhtml/grid'
], function () {
    'use strict';

    return function (config) {
        var selectedProducts = config.selectedProducts,
            products = $H(selectedProducts),
            gridJsObject = window[config.gridJsObjectName],
            checklist = config.checkProducts,
            tabIndex = 1000;
        /**
         * Show selected product when edit form in associated product grid
         */
        $('ks_products').value = Object.toJSON(products);
        
        /**
         * Register Category Product
         *
         * @param {Object} grid
         * @param {Object} element
         * @param {Boolean} checked
         */
        function roducts(grid, element, checked) {
            if (checked) {
                products.set(element.value,'');
            } else {
                products.unset(element.value);
            }
            $('ks_products').value = Object.toJSON(products);
            grid.reloadParams = {
                'selected_products[]': products.keys()
            };
        }

        /**
         * Click on product row
         *
         * @param {Object} grid
         * @param {String} event
         */
        function productRowClick(grid, event) {
            var trElement = Event.findElement(event, 'tr'),
                isInput = Event.element(event).tagName === 'INPUT',
                checked = false,
                checkbox = null;

            if (trElement) {
                checkbox = Element.getElementsBySelector(trElement, 'input');

                if (checkbox[0]) {
                    checked = isInput ? checkbox[0].checked : !checkbox[0].checked;
                    gridJsObject.setCheckboxChecked(checkbox[0], checked);
                }
            }
        }

        /**
         * Initialize category product row
         *
         * @param {Object} grid
         * @param {String} row
         */
        function productRowInit(grid, row) {
            var checkbox = $(row).getElementsByClassName('checkbox')[0];
            jQuery.each(checklist , function(index, val) { 
                jQuery('#id_'+val).prop('checked', true);
            });
        }

        gridJsObject.rowClickCallback = productRowClick;
        gridJsObject.initRowCallback = productRowInit;
        gridJsObject.checkboxCheckCallback = products;

        if (gridJsObject.rows) {
            gridJsObject.rows.each(function (row) {
                productRowInit(gridJsObject, row);
            });
        }
    };
});
