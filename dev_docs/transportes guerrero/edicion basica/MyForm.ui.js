/*
 * File: MyForm.ui.js
 * Date: Mon May 20 2013 19:01:40 GMT-0600 (Hora verano, Montañas (México))
 * 
 * This file was generated by Ext Designer version 1.1.2.
 * http://www.sencha.com/products/designer/
 *
 * This file will be auto-generated each and everytime you export.
 *
 * Do NOT hand edit this file.
 */

MyFormUi = Ext.extend(Ext.form.FormPanel, {
    title: 'Nuevo Viaje',
    width: 563,
    height: 620,
    padding: 10,
    initComponent: function() {
        this.items = [
            {
                xtype: 'container',
                layout: 'column',
                width: 375,
                items: [
                    {
                        xtype: 'container',
                        layout: 'form',
                        labelAlign: 'top',
                        style: 'margin-left:10px',
                        items: [
                            {
                                xtype: 'displayfield',
                                fieldLabel: 'Serie',
                                anchor: '100%',
                                value: 'A',
                                style: 'font-size:24px;'
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'form',
                        labelAlign: 'top',
                        style: 'margin-left:10px',
                        items: [
                            {
                                xtype: 'displayfield',
                                fieldLabel: 'Folio',
                                anchor: '100%',
                                value: 520,
                                style: 'font-size:20px;'
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'form',
                        labelAlign: 'top',
                        style: 'margin-left:10px',
                        items: [
                            {
                                xtype: 'displayfield',
                                fieldLabel: 'Estado',
                                anchor: '100%',
                                value: 'PROGRAMADO',
                                style: 'font-size:20px; color:orange;'
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'form',
                        labelAlign: 'top',
                        style: 'margin-left:10px',
                        items: [
                            {
                                xtype: 'displayfield',
                                fieldLabel: 'Costo total',
                                anchor: '100%',
                                value: '$0.00',
                                style: 'font-size:20px; text-align:right;'
                            }
                        ]
                    }
                ]
            },
            {
                xtype: 'fieldset',
                title: 'Datos de entrega',
                layout: 'table',
                width: 523,
                layoutConfig: {
                    columns: 3
                },
                items: [
                    {
                        xtype: 'container',
                        layout: 'form',
                        labelAlign: 'top',
                        items: [
                            {
                                xtype: 'combo',
                                fieldLabel: 'Cliente',
                                anchor: '100%',
                                width: 240
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'form',
                        labelAlign: 'top',
                        style: 'margin-left:10px;',
                        items: [
                            {
                                xtype: 'datefield',
                                fieldLabel: 'Fecha solicitada',
                                anchor: '100%'
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'form',
                        labelAlign: 'top',
                        style: 'margin-left:10px;',
                        items: [
                            {
                                xtype: 'timefield',
                                fieldLabel: 'Hora solicitada',
                                anchor: '100%',
                                width: 100
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'form',
                        labelAlign: 'top',
                        colspan: 3,
                        items: [
                            {
                                xtype: 'textfield',
                                fieldLabel: 'Contenido',
                                anchor: '100%',
                                width: 150
                            },
                            {
                                xtype: 'textfield',
                                fieldLabel: 'Direccion de entrega',
                                anchor: '100%',
                                width: 150
                            }
                        ]
                    }
                ]
            },
            {
                xtype: 'fieldset',
                title: 'Datos internos',
                width: 524,
                collapsible: true,
                items: [
                    {
                        xtype: 'container',
                        layout: 'table',
                        width: 663,
                        items: [
                            {
                                xtype: 'container',
                                layout: 'form',
                                labelAlign: 'top',
                                style: 'margin-left:10px',
                                items: [
                                    {
                                        xtype: 'combo',
                                        fieldLabel: 'Chofer',
                                        anchor: '100%',
                                        width: 150
                                    }
                                ]
                            },
                            {
                                xtype: 'container',
                                layout: 'form',
                                labelAlign: 'top',
                                style: 'margin-left:10px',
                                items: [
                                    {
                                        xtype: 'combo',
                                        fieldLabel: 'Vehiculo',
                                        anchor: '100%'
                                    }
                                ]
                            },
                            {
                                xtype: 'container',
                                layout: 'form',
                                labelAlign: 'top',
                                style: 'margin-left:10px',
                                items: [
                                    {
                                        xtype: 'combo',
                                        fieldLabel: 'Caja',
                                        anchor: '100%',
                                        width: 150
                                    }
                                ]
                            }
                        ]
                    }
                ]
            },
            {
                xtype: 'editorgrid',
                title: 'Gastos',
                height: 250,
                collapsible: true,
                width: 523,
                autoExpandColumn: 'concepto',
                columns: [
                    {
                        xtype: 'gridcolumn',
                        dataIndex: 'string',
                        header: 'Concepto',
                        sortable: true,
                        width: 200,
                        id: 'concepto',
                        editor: {
                            xtype: 'combo'
                        }
                    },
                    {
                        xtype: 'numbercolumn',
                        dataIndex: 'number',
                        header: 'Cantidad  ($)',
                        sortable: true,
                        width: 100,
                        align: 'right',
                        editor: {
                            xtype: 'numberfield',
                            style: 'text-align:right;'
                        }
                    },
                    {
                        xtype: 'datecolumn',
                        dataIndex: 'date',
                        header: 'Fecha',
                        sortable: true,
                        width: 100,
                        editor: {
                            xtype: 'datefield'
                        }
                    }
                ],
                tbar: {
                    xtype: 'toolbar',
                    width: 431,
                    items: [
                        {
                            xtype: 'button',
                            text: 'Agregar',
                            icon: 'http://png.findicons.com/files/icons/99/office/16/add1.png'
                        },
                        {
                            xtype: 'button',
                            text: 'Borrar',
                            icon: 'http://png.findicons.com/files/icons/2226/matte_basic/16/remove.png'
                        }
                    ]
                }
            }
        ];
        this.tbar = {
            xtype: 'toolbar',
            items: [
                {
                    xtype: 'button',
                    text: 'Guardar',
                    icon: 'http://png.findicons.com/files/icons/2166/oxygen/32/document_save.png',
                    scale: 'large'
                },
                {
                    xtype: 'button',
                    text: 'Nuevo',
                    scale: 'large',
                    icon: 'http://png.findicons.com/files/icons/573/must_have/32/new.png'
                },
                {
                    xtype: 'button',
                    text: 'Cancelar',
                    icon: 'http://png.findicons.com/files/icons/1572/minicons/32/stop.png',
                    scale: 'large'
                },
                {
                    xtype: 'button',
                    text: 'Print',
                    icon: 'http://png.findicons.com/files/icons/753/gnome_desktop/32/gnome_printer.png',
                    scale: 'large'
                },
                {
                    xtype: 'button',
                    text: 'Email',
                    icon: 'http://png.findicons.com/files/icons/573/must_have/32/mail.png',
                    scale: 'large'
                },
                {
                    xtype: 'tbseparator'
                },
                {
                    xtype: 'button',
                    text: 'Imprimir datos de entrega',
                    icon: 'http://png.findicons.com/files/icons/42/basic/32/print.png',
                    scale: 'large'
                }
            ]
        };
        MyFormUi.superclass.initComponent.call(this);
    }
});