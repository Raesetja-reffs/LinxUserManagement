@extends('layout.base')
@section('title', 'Dashboard')
@php $includeNav = true; @endphp {{-- TRUE TO INCLUDE SIDE NAV BAR TO PAGE --}}
@section('page') {{-- HTML CONTENT GOES IN THIS SECTION --}}

<div id="gridUsers" style="height:100%;"></div>

@endsection
@section('scripts') {{-- JS CONTENT GOES IN THIS SECTION --}}

<script>
    $(document).ready(function() {
        const gridUsers =  $("#gridUsers").dxDataGrid({
            dataSource:[], //as json
            hoverStateEnabled: true,
            showBorders: true,
            filterRow: { visible: true },
            filterPanel: { visible: true },
            headerFilter: { visible: true },
            allowColumnResizing: true,
            columnAutoWidth: true,
            scrolling: {
                rowRenderingMode: 'infinite',
            },
            paging:{
                enabled: false
            },
            export: {
                enabled: true
            },
            selection: {
                mode: 'single',
            },
            onExporting(e) {
                const workbook = new ExcelJS.Workbook();
                const worksheet = workbook.addWorksheet('users');

                DevExpress.excelExporter.exportDataGrid({
                    component: e.component,
                    worksheet,
                    autoFilterEnabled: true,
                }).then(() => {
                    workbook.xlsx.writeBuffer().then((buffer) => {
                        saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'users.xlsx');
                    });
                });
                e.cancel = true;
            },
            editing: {
                mode: 'row',
                allowUpdating: true,
                allowDeleting: true,
                allowAdding: true,
            },
            // columnChooser: {
            //     enabled: true,
            //     mode: 'select',
            //     position: {
            //         my: 'right top',
            //         at: 'right bottom',
            //         of: '.dx-datagrid-column-chooser-button',
            //     },
            //     search: {
            //         enabled: true,
            //         editorOptions: { placeholder: 'Search column' },
            //     },
            //     selection: {
            //         recursive: true,
            //         selectByClick: true,
            //         allowSelectAll: true,
            //     },
            // },
            // columns: [
            //     {
            //         dataField: "UserID",
            //         caption: "User Id",
            //     },
            //     {
            //         dataField: "PastelUser",
            //         caption: "Pastel User",
            //     },
            //     {
            //         dataField: "UserName",
            //         caption: "User User",
            //     },
            //     {
            //         dataField: "Administrator",
            //         caption: "Administrator",
            //     },
            //     {
            //         dataField: "Password",
            //         caption: "Password",
            //     },
            //     {
            //         dataField: "GroupId",
            //         caption: "GroupId",
            //     },
            //     {
            //         dataField: "LoggedIn",
            //         caption: "Logged In",
            //     },
            //     {
            //         dataField: "PrinterPathInvoice",
            //         caption: "Invoice Printer",
            //     },
            //     {
            //         dataField: "PrinterPathCreditNote",
            //         caption: "Credit Note Printer",
            //     },
            //     {
            //         dataField: "PrinterPathPickingSlip",
            //         caption: "Picking Slip Printer",
            //     },
            //     {
            //         dataField: "PrinterPathPurchaseOrder",
            //         caption: "Purchase Order Printer",
            //     },
            //     {
            //         dataField: "PrinterPathTruckControl",
            //         caption: "Truck Control Sheet Printer",
            //     },
            //     {
            //         dataField: "LocationId",
            //         caption: "Location",
            //     },
            //     {
            //         dataField: "strPickingTeams",
            //         caption: "Picking Team",
            //     },
            //     {
            //         dataField: "strQRCode",
            //         caption: "QR Code",
            //     },
            //     {
            //         dataField: "strField6",
            //         caption: "Encrypted",
            //         visible: false,
            //     },
            // ],
            onRowInserted: function(e) {
                const insertedRowData = e.data;

                const postData = {
                    insertedRowData
                };
                console.log(postData);
            },
            onRowUpdated: function(e) {
                console.log('RowUpdated');
            },
            onRowRemoved: function(e) {
                console.log('RowRemoved');
            },
            onToolbarPreparing: function (e) {
                // Create a custom header on the left side
                e.toolbarOptions.items.unshift(
                    {
                        location: 'before',
                        template: function () {
                            return $('<h3>').text('USERS');
                        }
                    }
                );
            },

        }).dxDataGrid('instance');

        getDimsUsers();

        function getDimsUsers(){
            $.ajax({
                url: '{!!url("/getDimsUsers")!!}',
                type: "POST",
                data: {
                },
                success: function(data) {
                    console.log(data);
                    gridUsers.option('dataSource', data);
                    gridUsers.refresh();
                }
            });
        }

        function createDimsUsers(){
            
        }
    });
</script>

@endsection