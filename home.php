<?php

$objWorkflowModel = WorkflowModel::loadById(1);//WorkflowModel::loadByMainIndex("amd-14");

$out_scr = $objWorkflowModel->displayTransitionTreeview();
$out_scr .= "<script type=\"text/javascript\">
        // -- init -- //
        jsPlumb.ready(function() {

            // connection lines style
            var connectorPaintStyle = {
                lineWidth:3,
                strokeStyle:\"#4F81BE\",
                joinstyle:\"round\"
            };

            var pdef = {
                // disable dragging
                DragOptions: null,
                // the tree container
                Container : \"treemain\"
            };
            var plumb = jsPlumb.getInstance(pdef);

            // all sizes are in pixels
            var opts = {
                
                prefix: 'node_',
                // left margin of the root node
                baseLeft: 24,
                // top margin of the root node
                baseTop: 24,
                // node width
                nodeWidth: 100,
                // horizontal margin between nodes
                hSpace: 36,
                // vertical margin between nodes
                vSpace: 10,
                imgPlus: '../lib/images/tree_expand.png',
                imgMinus: '../lib/images/tree_collapse.png',
                // queste non sono tutte in pixel
                sourceAnchor: [ 1, 0.5, 1, 0, 10, 0 ],
                targetAnchor: \"LeftMiddle\",
                sourceEndpoint: {
                    endpoint:[\"Image\", {url: \"../lib/images/tree_collapse.png\"}],
                    cssClass:\"collapser\",
                    isSource:true,
                    connector:[ \"Flowchart\", { stub:[40, 60], gap:[10, 0], cornerRadius:5, alwaysRespectStubs:false } ],
                    connectorStyle:connectorPaintStyle,
                    enabled: false,
                    maxConnections:-1,
                    dragOptions:null
                },
                targetEndpoint: {
                    endpoint:\"Blank\",
                    maxConnections:-1,
                    dropOptions:null,
                    enabled: false,
                    isTarget:true
                },
                connectFunc: function(tree, node) {
                    var cid = node.data('id');
                    console.log('Connecting node ' + cid);
                }
            };
            var tree = jQuery.jsPlumbTree(plumb, opts);
            tree.init();
            window.treemain = tree;
        });

        function positioningBlockBug() {
            var oldNode = window.treemain.nodeById(2);
            //var newNode = $('#node_2_new');
            var newNode = $('    <div id=\"node_2\" class=\"window hidden\"\\n' +
                '         data-id=\"2\"\\n' +
                '         data-parent=\"0\"\\n' +
                '         data-first-child=\"6\"\\n' +
                '         data-next-sibling=\"3\">\\n' +
                '        Node 2 NEW\\n' +
                '    </div>\\n');
            if (oldNode) {
                // butta il nodo nel container
                oldNode.replaceWith(newNode);
                // rimostra il nodo
                newNode.id = 'node_2';
                newNode.show();
                // aggiorna l'albero
                window.treemain.update();
            }

        }

    </script>";